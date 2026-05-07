#!/usr/bin/env python3
"""
PDF Table Extractor for LIMS Supplementary Files
Extracts microbial data tables from PDF text and outputs JSON
"""

import sys
import json
import re
from pathlib import Path

try:
    import pdfplumber
except ImportError:
    print(json.dumps({
        "success": False,
        "error": "pdfplumber not installed. Run: pip3 install pdfplumber"
    }))
    sys.exit(1)


def extract_tables_from_pdf(pdf_path, project_id):
    """
    Extract tables from PDF using pdfplumber's table extraction
    """
    results = []
    debug_info = []
    
    try:
        with pdfplumber.open(pdf_path) as pdf:
            total_pages = len(pdf.pages)
            debug_info.append(f"Total pages: {total_pages}")
            
            # Process all pages to find tables (more flexible approach)
            for page_num in range(total_pages):
                page = pdf.pages[page_num]
                text = page.extract_text()
                
                if not text:
                    continue
                
                debug_info.append(f"\n=== Page {page_num + 1} ===")
                debug_info.append(f"Text length: {len(text)}")
                
                # Detect which table this is
                table_name = None
                if 'Table 1' in text and 'Human-specific' in text:
                    table_name = 'Table 1 - Human-specific'
                    debug_info.append(f"Table detected: {table_name}")
                elif 'Table 2' in text and 'Faecal-specific' in text:
                    table_name = 'Table 2 - Faecal-specific'
                    debug_info.append(f"Table detected: {table_name}")
                elif 'Table 3' in text and 'Faecal-source' in text:
                    table_name = 'Table 3 - Faecal-source'
                    debug_info.append(f"Table detected: {table_name}")
                
                if not table_name:
                    debug_info.append("No table detected on this page")
                    continue
                
                # Try text parsing directly (pdfplumber table extraction doesn't work well for this PDF format)
                debug_info.append("Using text parsing...")
                parsed = parse_text_table(text, table_name, project_id, page_num + 1)
                results.extend(parsed['data'])
                debug_info.append(parsed['debug'])
        
        debug_info.append(f"\nTotal records extracted: {len(results)}")
        
        return {
            "success": True,
            "data": results,
            "count": len(results),
            "debug": "\n".join(debug_info)
        }
        
    except Exception as e:
        import traceback
        return {
            "success": False,
            "error": str(e),
            "traceback": traceback.format_exc(),
            "data": [],
            "debug": "\n".join(debug_info)
        }


def parse_text_table(text, table_name, project_id, page_num):
    """
    Parse table from plain text
    Handles both row-based and matrix-based table formats
    """
    results = []
    debug_info = []
    
    # Define expected sources for each table
    if table_name == 'Table 1 - Human-specific':
        sources = ['Human', 'Unknown']
    elif table_name == 'Table 2 - Faecal-specific':
        sources = ['Bat', 'Bird', 'Cat', 'Chicken', 'Cow', 'Deer', 'Dog', 'Fox', 
                  'Horse', 'Human', 'Kangaroo', 'Possum', 'Rabbit', 'Rat', 
                  'Sheep', 'Wallaby', 'Waterbird', 'Wombat', 'Unknown']
    elif table_name == 'Table 3 - Faecal-source':
        sources = ['Bat', 'Bird', 'Cat', 'Chicken', 'Cow', 'Deer', 'Dog', 'Fox', 
                  'Horse', 'Human', 'Kangaroo', 'Possum', 'Rabbit', 'Rat', 
                  'Sheep', 'Wallaby', 'Waterbird', 'Wombat']
    else:
        sources = []
    
    debug_info.append(f"Parsing {table_name} (expects {len(sources)} sources)")
    
    lines = text.split('\n')
    
    # Try to detect table format
    # Format 1: Row-based (Table 1) - Sample IDs in first column, data in same row
    # Format 2: Matrix-based (Table 2 & 3) - Sample IDs as column headers, sources as row headers
    
    # Look for a line with multiple sample IDs (indicates matrix format)
    sample_header_line = None
    sample_ids = []
    
    for line_idx, line in enumerate(lines):
        # Count sample IDs in this line - support both P2500xxx and P2600xxx formats
        ids_in_line = re.findall(r'P\d{7}', line)
        if len(ids_in_line) >= 3:  # If 3+ sample IDs in one line, it's likely the header
            sample_header_line = line_idx
            sample_ids = ids_in_line
            debug_info.append(f"Matrix format detected: {len(sample_ids)} samples in header (line {line_idx})")
            break
    
    if sample_header_line is not None:
        # Matrix format - parse by source rows
        debug_info.append(f"Sample IDs: {sample_ids}")
        
        # Process each source line
        for source_name in sources:
            # Find the line that starts with this source name
            for line_idx, line in enumerate(lines):
                # Clean line and check if it starts with source name
                clean_line = line.strip()
                if clean_line.startswith(source_name + ' ') or clean_line == source_name:
                    # Extract all values from this line (percentages or dashes)
                    # Split by whitespace and filter
                    parts = re.split(r'\s+', clean_line)
                    
                    # First part should be the source name, rest are values
                    if len(parts) < 2:
                        continue
                    
                    values = parts[1:]  # Skip source name
                    
                    debug_info.append(f"  {source_name}: found {len(values)} values: {values}")
                    
                    # Map values to sample IDs
                    for idx, value in enumerate(values):
                        if idx >= len(sample_ids):
                            break
                        
                        sample_id = sample_ids[idx]
                        
                        # Handle different value types
                        perc_val = None
                        
                        # Check if value is a percentage
                        perc_match = re.search(r'(\d+\.?\d*)\s*%', value)
                        if perc_match:
                            perc_val = float(perc_match.group(1))
                        elif value == '-':
                            # Dash means no data/not applicable - store as NULL
                            perc_val = None
                        elif re.match(r'^\d+\.?\d*$', value):
                            # Pure number without % sign
                            perc_val = float(value)
                        
                        # Only add record if we have a valid percentage value
                        if perc_val is not None:
                            results.append({
                                'id_project': project_id,
                                'id_one_water_sample': sample_id,
                                'table_name': table_name,
                                'source_name': source_name,
                                'percentage_value': perc_val,
                                'page_source': page_num
                            })
                        else:
                            debug_info.append(f"    Skipping {sample_id} {source_name}: value '{value}' (dash or invalid)")
                    
                    break  # Found this source, move to next
    
    else:
        # Row-based format (Table 1) - original logic with enhancements
        debug_info.append("Row-based format detected")
        
        sample_positions = []
        for line_idx, line in enumerate(lines):
            # Support both P2500xxx and P2600xxx formats
            for match in re.finditer(r'P\d{7}', line):
                sample_positions.append({
                    'sample_id': match.group(0),
                    'line_idx': line_idx,
                    'line': line,
                    'col_pos': match.start()
                })
        
        debug_info.append(f"Found {len(sample_positions)} sample IDs")
        
        for i, sample_info in enumerate(sample_positions):
            sample_id = sample_info['sample_id']
            line_idx = sample_info['line_idx']
            line = sample_info['line']
            
            end_line_idx = sample_positions[i + 1]['line_idx'] if i + 1 < len(sample_positions) else len(lines)
            
            data_text = ''
            sample_pos = line.find(sample_id)
            if sample_pos >= 0:
                data_text = line[sample_pos + len(sample_id):]
            
            for next_idx in range(line_idx + 1, min(end_line_idx, line_idx + 5)):
                if next_idx < len(lines):
                    next_line = lines[next_idx]
                    if re.search(r'P\d{7}', next_line):
                        break
                    data_text += ' ' + next_line
            
            # Enhanced percentage extraction - handle both % and plain numbers
            percentages = []
            
            # First try to find percentages with % sign
            perc_matches = re.findall(r'(\d+\.?\d*)\s*%', data_text)
            if perc_matches:
                percentages = [float(p) for p in perc_matches]
            else:
                # Try to find plain numbers (fallback)
                num_matches = re.findall(r'\b(\d+\.?\d*)\b', data_text)
                if num_matches:
                    percentages = [float(n) for n in num_matches]
            
            if not percentages:
                continue
            
            debug_info.append(f"  {sample_id}: {len(percentages)} percentages: {percentages}")
            
            for idx, percentage in enumerate(percentages):
                if idx < len(sources):
                    source_name = sources[idx]
                    
                    results.append({
                        'id_project': project_id,
                        'id_one_water_sample': sample_id,
                        'table_name': table_name,
                        'source_name': source_name,
                        'percentage_value': percentage,
                        'page_source': page_num
                    })
    
    debug_info.append(f"Extracted {len(results)} records")
    
    return {
        'data': results,
        'debug': '\n'.join(debug_info)
    }


def main():
    """Main entry point"""
    if len(sys.argv) < 3:
        print(json.dumps({
            "success": False,
            "error": "Usage: python3 extract_pdf_tables.py <pdf_path> <project_id>"
        }))
        sys.exit(1)
    
    pdf_path = sys.argv[1]
    project_id = sys.argv[2]
    
    # Check if file exists
    if not Path(pdf_path).exists():
        print(json.dumps({
            "success": False,
            "error": f"PDF file not found: {pdf_path}"
        }))
        sys.exit(1)
    
    # Extract tables
    result = extract_tables_from_pdf(pdf_path, project_id)
    
    # Output JSON
    print(json.dumps(result, indent=2))


if __name__ == "__main__":
    main()