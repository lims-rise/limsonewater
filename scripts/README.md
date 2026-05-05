# PDF Table Extraction Setup

## Prerequisites

Python 3.x must be installed on your system.

## Installation

Install required Python library:

```bash
pip3 install pdfplumber
```

## Usage

The script is automatically called by the PHP application when a supplementary PDF is uploaded.

### Manual Testing

You can test the script manually:

```bash
python3 scripts/extract_pdf_tables.py path/to/pdf/file.pdf PROJECT_ID
```

Example:
```bash
python3 scripts/extract_pdf_tables.py uploads/supplementary/supplementary_MU2500040.pdf MU2500040
```

## Output

The script outputs JSON with the following structure:

```json
{
  "success": true,
  "data": [
    {
      "id_project": "MU2500040",
      "id_one_water_sample": "P2500212",
      "table_name": "Table 1 - Human-specific",
      "source_name": "Human",
      "percentage_value": 100.0,
      "page_source": 3
    }
  ],
  "count": 10
}
```

## Troubleshooting

If you get "pdfplumber not installed" error:
```bash
pip3 install --upgrade pdfplumber
```

If Python 3 is not found:
```bash
which python3
```

Make sure the path matches what's used in the PHP exec() call.
