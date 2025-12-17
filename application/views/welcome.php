<style>
/* ================================
   🌤️ MODERN UI 2025 — Color System
=================================*/
:root {
  --ui-bg: #F7F8FA;
  --ui-surface: #FFFFFF;
  --ui-surface-alt: #F1F3F5;

  --ui-text: #1A1D21;
  --ui-text-secondary: #6B7178;
  --ui-border: #E2E4E8;

  /* 2025 accent colors */
  --ui-accent: #4D6EF5;              /* Soft Indigo Blue */
  --ui-accent-soft: #E7EBFF;

  /* Feedback colors (muted) */
  --ui-success: #3FB984;
  --ui-warning: #F5C04D;
  --ui-danger: #E05B5B;

  /* Elevation */
  --ui-shadow-sm: 0 2px 6px rgba(0,0,0,0.05);
  --ui-shadow-md: 0 4px 12px rgba(0,0,0,0.07);
  --ui-radius: 12px;
}

/* Modern Scrollbar */
::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(180deg, var(--ui-accent), #6B7EF7);
  border-radius: 4px;
}

::-webkit-scrollbar-track {
  background: var(--ui-surface-alt);
}

/* Dashboard Specific Styling - Scoped to avoid affecting global elements */
.dashboard-container {
  background: var(--ui-bg) !important;
}

.dashboard-container .content-wrapper {
  background: var(--ui-bg) !important;
}

/* Modern Box Styling - Dashboard Scoped */
.dashboard-container .box {
  background: var(--ui-surface) !important;
  border: 1px solid var(--ui-border) !important;
  border-radius: var(--ui-radius) !important;
  box-shadow: var(--ui-shadow-sm) !important;
  transition: all 0.3s ease !important;
}

.dashboard-container .box:hover {
  box-shadow: var(--ui-shadow-md) !important;
}

.dashboard-container .box-header {
  background: var(--ui-surface) !important;
  border-bottom: 1px solid var(--ui-border) !important;
  border-radius: var(--ui-radius) var(--ui-radius) 0 0 !important;
}

.dashboard-container .box-title {
  color: var(--ui-text) !important;
  font-weight: 600 !important;
  font-size: 18px !important;
}

.dashboard-container .box-body {
  background: var(--ui-surface) !important;
  color: var(--ui-text) !important;
}

/* ========================================== */
/* WELCOME HEADER - MODERN UI 2025 */
/* ========================================== */

/* Modern Welcome Header Container */
.modern-welcome-header {
  background: rgba(255, 255, 255, 0.35) !important;
  backdrop-filter: blur(25px) !important;
  -webkit-backdrop-filter: blur(25px) !important;
  border: none !important;
  border-radius: 24px !important;
  box-shadow: 
    0 12px 40px rgba(0, 0, 0, 0.15),
    0 4px 20px rgba(0, 0, 0, 0.08) !important;
  overflow: hidden !important;
  margin-bottom: 25px !important;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.modern-welcome-header:hover {
  transform: translateY(-2px) !important;
  box-shadow: 
    0 20px 40px rgba(0, 0, 0, 0.15),
    0 4px 24px rgba(0, 0, 0, 0.08),
    inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
}

/* Modern Welcome Header Content */
.modern-welcome-header .box-header {
  background: linear-gradient(135deg, rgba(77, 110, 245, 0.1) 0%, rgba(107, 126, 247, 0.1) 100%) !important;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
  padding: 20px 25px !important;
}

.modern-welcome-title {
  display: flex !important;
  align-items: center !important;
  gap: 12px !important;
  margin: 0 !important;
}

.welcome-icon-wrapper {
  width: 48px !important;
  height: 48px !important;
  background: linear-gradient(135deg, #4D6EF5 0%, #6B7EF7 100%) !important;
  border-radius: 12px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  box-shadow: 0 4px 12px rgba(77, 110, 245, 0.3) !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.welcome-icon-wrapper:hover {
  transform: scale(1.05) !important;
  box-shadow: 0 6px 20px rgba(77, 110, 245, 0.4) !important;
}

.welcome-icon {
  color: white !important;
  font-size: 20px !important;
}

.welcome-text-content {
  display: flex !important;
  flex-direction: column !important;
  gap: 4px !important;
}

.welcome-main-title {
  font-size: 24px !important;
  font-weight: 700 !important;
  color: var(--ui-text) !important;
  line-height: 1.2 !important;
  margin: 0 !important;
  background: linear-gradient(135deg, var(--ui-text) 0%, rgba(77, 110, 245, 0.8) 100%) !important;
  -webkit-background-clip: text !important;
  -webkit-text-fill-color: transparent !important;
  background-clip: text !important;
}

.welcome-subtitle {
  font-size: 14px !important;
  color: var(--ui-text-secondary) !important;
  opacity: 0.8 !important;
  font-weight: 500 !important;
}

.welcome-user-badge {
  display: flex !important;
  align-items: center !important;
  gap: 8px !important;
  padding: 10px 16px !important;
  background: rgba(77, 110, 245, 0.1) !important;
  border: 1px solid rgba(77, 110, 245, 0.2) !important;
  border-radius: 25px !important;
  color: var(--ui-accent) !important;
  font-weight: 600 !important;
  font-size: 13px !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.welcome-user-badge:hover {
  background: rgba(77, 110, 245, 0.15) !important;
  border-color: rgba(77, 110, 245, 0.3) !important;
  transform: translateY(-1px) !important;
}

.user-badge-icon {
  font-size: 12px !important;
}

/* Time Badge */
.welcome-time-badge {
  display: flex !important;
  align-items: center !important;
  gap: 8px !important;
  padding: 10px 16px !important;
  background: rgba(245, 192, 77, 0.1) !important;
  border: 1px solid rgba(245, 192, 77, 0.2) !important;
  border-radius: 25px !important;
  color: var(--ui-warning) !important;
  font-weight: 600 !important;
  font-size: 13px !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  margin-right: 10px !important;
}

.welcome-time-badge:hover {
  background: rgba(245, 192, 77, 0.15) !important;
  border-color: rgba(245, 192, 77, 0.3) !important;
  transform: translateY(-1px) !important;
}

.time-badge-icon {
  font-size: 12px !important;
}

/* Welcome Header Layout */
.welcome-header-layout {
  display: flex !important;
  justify-content: space-between !important;
  align-items: center !important;
  width: 100% !important;
  padding: 0 !important;
}

.welcome-left-section {
  display: flex !important;
  align-items: center !important;
  gap: 16px !important;
  flex: 1 !important;
}

.welcome-right-section {
  display: flex !important;
  align-items: center !important;
  gap: 12px !important;
  flex-shrink: 0 !important;
}

/* Updated Welcome Title */
.modern-welcome-title {
  display: flex !important;
  align-items: center !important;
  gap: 16px !important;
  flex: 1 !important;
}

/* Box Tools Alignment */
.modern-welcome-header .box-tools {
  display: flex !important;
  align-items: center !important;
  gap: 0 !important;
}

/* Responsive Welcome Header */
@media (max-width: 992px) {
  .welcome-header-layout {
    flex-direction: column !important;
    gap: 15px !important;
    align-items: flex-start !important;
  }
  
  .welcome-left-section {
    width: 100% !important;
  }
  
  .welcome-right-section {
    width: 100% !important;
    justify-content: flex-end !important;
  }
}

@media (max-width: 768px) {
  .welcome-left-section {
    flex-direction: column !important;
    gap: 10px !important;
    align-items: flex-start !important;
  }
  
  .welcome-right-section {
    flex-direction: column !important;
    gap: 8px !important;
    align-items: flex-end !important;
  }
  
  .welcome-time-badge,
  .welcome-user-badge {
    font-size: 12px !important;
    padding: 8px 12px !important;
  }
}

/* ========================================== */
/* SUMMARY CARDS - MODERN UI 2025 */
/* ========================================== */

/* Modern Summary Card */
.modern-summary-card {
  background: rgba(255, 255, 255, 0.35) !important;
  backdrop-filter: blur(25px) !important;
  -webkit-backdrop-filter: blur(25px) !important;
  border: none !important;
  border-radius: 24px !important;
  padding: 0 !important;
  overflow: hidden !important;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
  position: relative !important;
  box-shadow: 
    0 12px 40px rgba(0, 0, 0, 0.15),
    0 4px 20px rgba(0, 0, 0, 0.08) !important;
}

.modern-summary-card:hover {
  transform: translateY(-8px) !important;
  box-shadow: 
    0 20px 40px rgba(0, 0, 0, 0.15),
    0 4px 24px rgba(0, 0, 0, 0.08),
    inset 0 1px 0 rgba(255, 255, 255, 0.25) !important;
}

/* Card Color Overlays */
.card-aqua .modern-summary-card::before {
  content: '' !important;
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  bottom: 0 !important;
  background: linear-gradient(135deg, rgba(77, 110, 245, 0.75) 0%, rgba(107, 126, 247, 0.65) 100%) !important;
  pointer-events: none !important;
}

.card-green .modern-summary-card::before {
  content: '' !important;
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  bottom: 0 !important;
  background: linear-gradient(135deg, rgba(63, 185, 132, 0.75) 0%, rgba(82, 196, 154, 0.65) 100%) !important;
  pointer-events: none !important;
}

.card-yellow .modern-summary-card::before {
  content: '' !important;
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  bottom: 0 !important;
  background: linear-gradient(135deg, rgba(245, 192, 77, 0.75) 0%, rgba(247, 208, 99, 0.65) 100%) !important;
  pointer-events: none !important;
}

.card-red .modern-summary-card::before {
  content: '' !important;
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  bottom: 0 !important;
  background: linear-gradient(135deg, rgba(224, 91, 91, 0.75) 0%, rgba(231, 111, 111, 0.65) 100%) !important;
  pointer-events: none !important;
}

/* Card Content Layout */
.card-content-wrapper {
  position: relative !important;
  z-index: 2 !important;
  padding: 24px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  height: 120px !important;
}

.card-info {
  display: flex !important;
  flex-direction: column !important;
  gap: 8px !important;
  flex: 1 !important;
}

.card-number {
  font-size: 32px !important;
  font-weight: 800 !important;
  line-height: 1 !important;
  color: white !important;
  margin: 0 !important;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
}

/* Override untuk memastikan warna putih tetap tampil */
a .card-number,
a:hover .card-number,
a:focus .card-number,
a:visited .card-number {
  color: white !important;
}

.card-label {
  font-size: 14px !important;
  font-weight: 600 !important;
  color: white !important;
  margin: 0 !important;
  text-transform: uppercase !important;
  letter-spacing: 0.5px !important;
}

/* Override untuk memastikan warna putih tetap tampil */
a .card-label,
a:hover .card-label,
a:focus .card-label,
a:visited .card-label {
  color: white !important;
}

.card-icon-wrapper {
  width: 64px !important;
  height: 64px !important;
  border-radius: 16px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  background: rgba(255, 255, 255, 0.15) !important;
  backdrop-filter: blur(10px) !important;
}

.modern-summary-card:hover .card-icon-wrapper {
  transform: scale(1.1) rotate(5deg) !important;
}

.card-icon {
  font-size: 28px !important;
  opacity: 0.85 !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

/* Card Type Specific Icon Colors */
.card-aqua .card-icon {
  color: #4D6EF5 !important;
}

.card-green .card-icon {
  color: #3FB984 !important;
}

.card-yellow .card-icon {
  color: #F5C04D !important;
}

.card-red .card-icon {
  color: #E05B5B !important;
}

/* Card Footer */
.card-footer {
  position: absolute !important;
  bottom: 0 !important;
  left: 0 !important;
  right: 0 !important;
  height: 4px !important;
  background: rgba(255, 255, 255, 0.15) !important;
  overflow: hidden !important;
}

.card-footer::after {
  content: '' !important;
  position: absolute !important;
  top: 0 !important;
  left: -100% !important;
  width: 100% !important;
  height: 100% !important;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent) !important;
  transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.modern-summary-card:hover .card-footer::after {
  left: 100% !important;
}

/* Animation Enhancement */
.card-animate-1 {
  animation: cleanSlideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards !important;
  animation-delay: 0.1s !important;
}

.card-animate-2 {
  animation: cleanSlideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards !important;
  animation-delay: 0.2s !important;
}

.card-animate-3 {
  animation: cleanSlideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards !important;
  animation-delay: 0.3s !important;
}

.card-animate-4 {
  animation: cleanSlideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards !important;
  animation-delay: 0.4s !important;
}

@keyframes cleanSlideUp {
  from {
    opacity: 0 !important;
    transform: translateY(30px) !important;
  }
  to {
    opacity: 1 !important;
    transform: translateY(0) !important;
  }
}

/* Responsive Design */
@media (max-width: 768px) {
  .modern-welcome-header .box-header {
    padding: 16px 20px !important;
  }
  
  .welcome-icon-wrapper {
    width: 40px !important;
    height: 40px !important;
  }
  
  .welcome-main-title {
    font-size: 20px !important;
  }
  
  .card-content-wrapper {
    padding: 20px !important;
    height: 100px !important;
  }
  
  .card-number {
    font-size: 24px !important;
  }
  
  .card-icon-wrapper {
    width: 48px !important;
    height: 48px !important;
  }
  
  .card-icon {
    font-size: 20px !important;
  }
}

/* Legacy Support - Keep small-box for compatibility */
.small-box {
  border-radius: var(--ui-radius) !important;
  box-shadow: var(--ui-shadow-md) !important;
  border: none !important;
  transition: all 0.3s ease !important;
  overflow: hidden !important;
}

.small-box:hover {
  transform: translateY(-2px) !important;
  box-shadow: 0 8px 25px rgba(77, 110, 245, 0.15) !important;
}

/* Modern 4-Level Progress Bar System (Matching Sample Reception) */
.dashboard-container .progress-bar {
    transition: width 0.5s ease-in-out !important;
}

/* Modern 4-Level Progress Bar System with Right-to-Left Darker Gradient */
#workflow-table .progress-bar-danger,
.dashboard-container .progress-bar-danger { 
    background: linear-gradient(90deg, #FFCDD2, #dd4b39) !important; /* Red: 0-49% - Light to dark red gradient */
}
#workflow-table .progress-bar-warning,
.dashboard-container .progress-bar-warning { 
    background: linear-gradient(90deg, #FFF3E0, #f39c12) !important; /* Yellow-Orange: 50-79% - Light to dark orange gradient */
}
#workflow-table .progress-bar-info,
.dashboard-container .progress-bar-info { 
    background: linear-gradient(90deg, #E3F2FD, #2196F3) !important; /* Blue: 80-99% - Light to dark blue gradient matching badges */
}
#workflow-table .progress-bar-success,
.dashboard-container .progress-bar-success { 
    background: linear-gradient(90deg, #E8F5E8, #00a65a) !important; /* Green: 100% - Light to dark green gradient */
}

/* Modern Status Labels - Solid Colors for Clean Look */
#workflow-table .label-danger, 
.dashboard-container .label-danger {
    background-color: #dd4b39 !important; /* Red: Incomplete - AdminLTE solid red */
    border: none !important;
    box-shadow: 0 2px 8px rgba(221, 75, 57, 0.25) !important;
    border-radius: 10px !important;
    color: #ffffff !important; /* White text for better contrast */
}
#workflow-table .label-warning, 
.dashboard-container .label-warning {
    background-color: #f39c12 !important; /* Yellow-Orange: In Progress - AdminLTE solid orange */
    border: none !important;
    box-shadow: 0 2px 8px rgba(243, 156, 18, 0.25) !important;
    border-radius: 10px !important;
    color: #ffffff !important; /* White text for better contrast */
}
#workflow-table .label-info, 
.dashboard-container .label-info {
    background-color: #2196F3 !important; /* Blue: Almost Done - Consistent with progress bar */
    border: none !important;
    box-shadow: 0 2px 8px rgba(33, 150, 243, 0.25) !important;
    border-radius: 10px !important;
    color: #ffffff !important; /* White text for better contrast */
}
#workflow-table .label-success, 
.dashboard-container .label-success {
    background-color: #00a65a !important; /* Green: Complete - AdminLTE solid green */
    border: none !important;
    box-shadow: 0 2px 8px rgba(0, 166, 90, 0.25) !important;
    border-radius: 10px !important;
    color: #ffffff !important; /* White text for better contrast */
}
#workflow-table .label-default, 
.dashboard-container .label-default {
    background-color: #95a5a6 !important; /* Grey: No Tests - AdminLTE solid grey */
    border: none !important;
    box-shadow: 0 2px 8px rgba(149, 165, 166, 0.25) !important;
    border-radius: 10px !important;
    color: #ffffff !important; /* White text for better contrast on grey background */
}

/* Updated Small Box Colors with 2025 Palette */
.small-box.bg-aqua {
  background: linear-gradient(135deg, var(--ui-accent) 0%, #6B7EF7 100%) !important;
}

.small-box.bg-green {
  background: linear-gradient(135deg, var(--ui-success) 0%, #52C49A 100%) !important;
}

.small-box.bg-yellow {
  background: linear-gradient(135deg, var(--ui-warning) 0%, #F7D063 100%) !important;
}

.small-box.bg-red {
  background: linear-gradient(135deg, var(--ui-danger) 0%, #E86F6F 100%) !important;
}

.small-box .inner h3 {
  color: white !important;
  font-weight: 700 !important;
  font-size: 28px !important;
}

.small-box .inner p {
  color: rgba(255, 255, 255, 0.9) !important;
  font-weight: 500 !important;
}

.small-box .icon {
  color: rgba(255, 255, 255, 0.15) !important;
}

/* ========================================== */
/* MODULE PERFORMANCE OVERVIEW - MODERN UI 2025 */
/* ========================================== */

/* Main Container */
.module-performance-container {
  background: rgba(255, 255, 255, 0.35) !important;
  backdrop-filter: blur(25px) !important;
  -webkit-backdrop-filter: blur(25px) !important;
  border: none !important;
  border-radius: 24px !important;
  box-shadow: 
    0 12px 40px rgba(0, 0, 0, 0.15),
    0 4px 20px rgba(0, 0, 0, 0.08) !important;
  overflow: hidden !important;
  margin-bottom: 25px !important;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.module-performance-container:hover {
  transform: translateY(-2px) !important;
  box-shadow: 
    0 20px 40px rgba(0, 0, 0, 0.15),
    0 4px 24px rgba(0, 0, 0, 0.08),
    inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
}

/* Header */
.module-performance-container .box-header {
  background: linear-gradient(135deg, rgba(77, 110, 245, 0.1) 0%, rgba(63, 185, 132, 0.1) 100%) !important;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
  padding: 20px 25px !important;
}

.module-performance-container .box-title {
  font-size: 18px !important;
  font-weight: 600 !important;
  color: var(--ui-text) !important;
  display: flex !important;
  align-items: center !important;
}

.module-status-indicator {
  display: flex !important;
  align-items: center !important;
  padding: 6px 12px !important;
  background: rgba(63, 185, 132, 0.1) !important;
  border-radius: 20px !important;
  border: 1px solid rgba(63, 185, 132, 0.2) !important;
}

/* Modern Table Wrapper */
.modern-table-wrapper {
  padding: 0 !important;
  background: transparent !important;
}

.modern-table-container {
  background: rgba(255, 255, 255, 0.15) !important;
  border-radius: 20px !important;
  margin: 20px !important;
  overflow: hidden !important;
  border: none !important;
}

/* Modern Performance Table */
.modern-performance-table {
  width: 100% !important;
  border-collapse: separate !important;
  border-spacing: 0 !important;
  background: transparent !important;
}

/* Modern Table Headers */
.modern-performance-thead {
  background: linear-gradient(135deg, rgba(107, 113, 120, 0.1) 0%, rgba(77, 110, 245, 0.05) 100%) !important;
}

.modern-performance-thead th {
  padding: 18px 20px !important;
  font-weight: 600 !important;
  font-size: 13px !important;
  text-transform: uppercase !important;
  letter-spacing: 0.5px !important;
  color: var(--ui-text-secondary) !important;
  border: none !important;
  position: relative !important;
}

.module-name-header {
  text-align: left !important;
  color: var(--ui-text) !important;
}

.metric-header,
.progress-header {
  text-align: center !important;
}

/* Modern Table Rows */
.modern-performance-tbody .module-row {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
  background: transparent !important;
}

.modern-performance-tbody .module-row:hover {
  background: linear-gradient(135deg, rgba(77, 110, 245, 0.08) 0%, rgba(63, 185, 132, 0.05) 100%) !important;
  transform: translateX(4px) !important;
}

.modern-performance-tbody .module-row:last-child {
  border-bottom: none !important;
}

/* Module Info Cell */
.module-name-cell {
  padding: 20px !important;
  border: none !important;
}

.module-info {
  display: flex !important;
  align-items: center !important;
  gap: 15px !important;
}

.module-icon-wrapper {
  width: 42px !important;
  height: 42px !important;
  background: linear-gradient(135deg, var(--ui-accent) 0%, rgba(77, 110, 245, 0.8) 100%) !important;
  border-radius: 12px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  box-shadow: 0 4px 12px rgba(77, 110, 245, 0.3) !important;
}

.module-icon {
  color: white !important;
  font-size: 16px !important;
}

.module-details {
  display: flex !important;
  flex-direction: column !important;
  gap: 4px !important;
}

.module-name {
  font-weight: 600 !important;
  font-size: 15px !important;
  color: var(--ui-text) !important;
  line-height: 1.2 !important;
}

.module-subtitle {
  font-size: 12px !important;
  color: var(--ui-text-secondary) !important;
  opacity: 0.8 !important;
}

/* Metric Cells */
.metric-cell {
  padding: 20px !important;
  text-align: center !important;
  border: none !important;
}

.modern-metric {
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  gap: 4px !important;
  padding: 8px 12px !important;
  border-radius: 10px !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  cursor: default !important;
}

.modern-metric:hover {
  transform: translateY(-2px) !important;
}

.total-metric:hover {
  background: rgba(77, 110, 245, 0.1) !important;
  box-shadow: 0 4px 12px rgba(77, 110, 245, 0.15) !important;
}

.completed-metric:hover {
  background: rgba(63, 185, 132, 0.1) !important;
  box-shadow: 0 4px 12px rgba(63, 185, 132, 0.15) !important;
}

.pending-metric:hover {
  background: rgba(245, 192, 77, 0.1) !important;
  box-shadow: 0 4px 12px rgba(245, 192, 77, 0.15) !important;
  cursor: pointer !important;
}

.metric-value {
  font-size: 18px !important;
  font-weight: 700 !important;
  color: var(--ui-text) !important;
  line-height: 1 !important;
}

.success-color {
  color: var(--ui-success) !important;
}

.warning-color {
  color: var(--ui-warning) !important;
}

.metric-label {
  font-size: 11px !important;
  font-weight: 500 !important;
  color: var(--ui-text-secondary) !important;
  text-transform: uppercase !important;
  letter-spacing: 0.5px !important;
}

/* Progress Cell */
.progress-cell {
  padding: 20px !important;
  text-align: center !important;
  border: none !important;
}

.modern-progress-container {
  display: flex !important;
  flex-direction: column !important;
  gap: 8px !important;
  align-items: center !important;
}

.progress-info {
  display: flex !important;
  align-items: center !important;
  gap: 8px !important;
}

.progress-percentage {
  font-size: 16px !important;
  font-weight: 700 !important;
  line-height: 1 !important;
}

.progress-status-icon {
  font-size: 14px !important;
  opacity: 0.8 !important;
}

.modern-progress-bar {
  width: 80px !important;
  height: 6px !important;
  position: relative !important;
  border-radius: 10px !important;
  overflow: hidden !important;
}

.progress-track {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  background: rgba(107, 113, 120, 0.15) !important;
  border-radius: 10px !important;
}

.progress-fill {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  height: 100% !important;
  border-radius: 10px !important;
  transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1) !important;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2) !important;
}

/* Responsive Design */
@media (max-width: 768px) {
  .module-performance-container {
    margin: 15px 10px !important;
    border-radius: 16px !important;
  }
  
  .modern-table-container {
    margin: 15px !important;
    border-radius: 12px !important;
  }
  
  .module-info {
    gap: 12px !important;
  }
  
  .module-icon-wrapper {
    width: 36px !important;
    height: 36px !important;
  }
  
  .module-name {
    font-size: 14px !important;
  }
  
  .metric-value {
    font-size: 16px !important;
  }
  
  .modern-progress-bar {
    width: 60px !important;
  }
}

/* Animation Enhancement */
.module-row[data-index]:nth-child(odd) {
  animation: slideInFromLeft 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards !important;
  animation-delay: calc(var(--index, 0) * 0.1s) !important;
}

.module-row[data-index]:nth-child(even) {
  animation: slideInFromRight 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards !important;
  animation-delay: calc(var(--index, 0) * 0.1s) !important;
}

@keyframes slideInFromLeft {
  from {
    opacity: 0 !important;
    transform: translateX(-20px) !important;
  }
  to {
    opacity: 1 !important;
    transform: translateX(0) !important;
  }
}

@keyframes slideInFromRight {
  from {
    opacity: 0 !important;
    transform: translateX(20px) !important;
  }
  to {
    opacity: 1 !important;
    transform: translateX(0) !important;
  }
}

/* ========================================== */
/* QUICK ACTIONS - MODERN UI 2025 */
/* ========================================== */

/* Main Container */
.modern-actions-container {
  background: rgba(255, 255, 255, 0.35) !important;
  backdrop-filter: blur(25px) !important;
  -webkit-backdrop-filter: blur(25px) !important;
  border: none !important;
  border-radius: 24px !important;
  box-shadow: 
    0 12px 40px rgba(0, 0, 0, 0.15),
    0 4px 20px rgba(0, 0, 0, 0.08) !important;
  overflow: hidden !important;
  margin-bottom: 25px !important;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.modern-actions-container:hover {
  transform: translateY(-2px) !important;
  box-shadow: 
    0 20px 40px rgba(0, 0, 0, 0.15),
    0 4px 24px rgba(0, 0, 0, 0.08),
    inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
}

/* Header */
.modern-actions-container .box-header {
  background: linear-gradient(135deg, rgba(63, 185, 132, 0.2) 0%, rgba(82, 196, 154, 0.15) 100%) !important;
  border-bottom: none !important;
  padding: 20px 25px !important;
}

.action-status-indicator {
  display: flex !important;
  align-items: center !important;
  padding: 6px 12px !important;
  background: rgba(63, 185, 132, 0.1) !important;
  border-radius: 20px !important;
  border: 1px solid rgba(63, 185, 132, 0.2) !important;
}

/* Actions Grid */
.modern-actions-grid {
  display: flex !important;
  flex-direction: column !important;
  gap: 12px !important;
  padding: 5px !important;
}

.action-item {
  width: 100% !important;
}

/* Modern Action Button */
.modern-action-btn {
  display: flex !important;
  align-items: center !important;
  width: 100% !important;
  padding: 16px 20px !important;
  background: rgba(255, 255, 255, 0.25) !important;
  border: none !important;
  border-radius: 20px !important;
  text-decoration: none !important;
  color: var(--ui-text) !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  position: relative !important;
  overflow: hidden !important;
}

.modern-action-btn:hover,
.modern-action-btn:focus {
  text-decoration: none !important;
  color: var(--ui-text) !important;
  background: rgba(255, 255, 255, 0.35) !important;
  transform: translateY(-2px) !important;
  box-shadow: 
    0 12px 30px rgba(0, 0, 0, 0.18),
    0 4px 15px rgba(0, 0, 0, 0.12) !important;
}

/* Action Icon */
.action-icon-wrapper {
  width: 48px !important;
  height: 48px !important;
  border-radius: 12px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  margin-right: 16px !important;
  flex-shrink: 0 !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.primary-action .action-icon-wrapper {
  background: linear-gradient(135deg, #3FB984 0%, #52C49A 100%) !important;
  box-shadow: 0 4px 12px rgba(63, 185, 132, 0.3) !important;
}

.secondary-action .action-icon-wrapper {
  background: linear-gradient(135deg, #4D6EF5 0%, #6B7EF7 100%) !important;
  box-shadow: 0 4px 12px rgba(77, 110, 245, 0.3) !important;
}

.tertiary-action .action-icon-wrapper {
  background: linear-gradient(135deg, #F5C04D 0%, #F7D063 100%) !important;
  box-shadow: 0 4px 12px rgba(245, 192, 77, 0.3) !important;
}

.action-icon {
  color: white !important;
  font-size: 18px !important;
}

/* Action Content */
.action-content {
  flex: 1 !important;
  display: flex !important;
  flex-direction: column !important;
  gap: 4px !important;
}

.action-title {
  font-size: 15px !important;
  font-weight: 600 !important;
  color: var(--ui-text) !important;
  line-height: 1.2 !important;
}

.action-subtitle {
  font-size: 12px !important;
  color: var(--ui-text-secondary) !important;
  opacity: 0.8 !important;
}

/* Action Arrow */
.action-arrow {
  margin-left: 12px !important;
  opacity: 0.6 !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.modern-action-btn:hover .action-arrow {
  opacity: 1 !important;
  transform: translateX(4px) !important;
}

/* ========================================== */
/* RECENT ACTIVITIES - MODERN UI 2025 */
/* ========================================== */

/* Main Container */
.modern-activities-container {
  background: rgba(255, 255, 255, 0.35) !important;
  backdrop-filter: blur(25px) !important;
  -webkit-backdrop-filter: blur(25px) !important;
  border: none !important;
  border-radius: 24px !important;
  box-shadow: 
    0 12px 40px rgba(0, 0, 0, 0.15),
    0 4px 20px rgba(0, 0, 0, 0.08) !important;
  overflow: hidden !important;
  margin-bottom: 25px !important;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.modern-activities-container:hover {
  transform: translateY(-2px) !important;
  box-shadow: 
    0 20px 40px rgba(0, 0, 0, 0.15),
    0 4px 24px rgba(0, 0, 0, 0.08),
    inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
}

/* Header */
.modern-activities-container .box-header {
  background: linear-gradient(135deg, rgba(245, 192, 77, 0.2) 0%, rgba(247, 208, 99, 0.15) 100%) !important;
  border-bottom: none !important;
  padding: 20px 25px !important;
}

.activity-status-indicator {
  display: flex !important;
  align-items: center !important;
  padding: 6px 12px !important;
  background: rgba(245, 192, 77, 0.1) !important;
  border-radius: 20px !important;
  border: 1px solid rgba(245, 192, 77, 0.2) !important;
}

/* Pulse Animation */
@keyframes pulse {
  0% { opacity: 1; }
  50% { opacity: 0.5; }
  100% { opacity: 1; }
}

/* Timeline Container */
.modern-timeline-container {
  padding: 5px !important;
  max-height: 400px !important;
  overflow-y: auto !important;
}

.modern-timeline {
  list-style: none !important;
  padding: 0 !important;
  margin: 0 !important;
  position: relative !important;
}

.modern-timeline::before {
  content: '' !important;
  position: absolute !important;
  left: 24px !important;
  top: 0 !important;
  bottom: 0 !important;
  width: 2px !important;
  background: linear-gradient(180deg, rgba(245, 192, 77, 0.3) 0%, rgba(245, 192, 77, 0.1) 100%) !important;
  border-radius: 1px !important;
}

/* Timeline Item */
.modern-timeline-item {
  display: flex !important;
  margin-bottom: 20px !important;
  position: relative !important;
  padding-left: 0 !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.modern-timeline-item:hover {
  transform: translateX(4px) !important;
}

.modern-timeline-item:last-child {
  margin-bottom: 0 !important;
}

/* Timeline Icon */
.timeline-icon-wrapper {
  width: 42px !important;
  height: 42px !important;
  background: linear-gradient(135deg, var(--ui-accent) 0%, rgba(77, 110, 245, 0.8) 100%) !important;
  border-radius: 12px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  box-shadow: 0 4px 12px rgba(77, 110, 245, 0.3) !important;
}

.timeline-icon {
  color: white !important;
  font-size: 14px !important;
}

/* Timeline Content */
.timeline-content {
  flex: 1 !important;
  background: rgba(255, 255, 255, 0.25) !important;
  border: none !important;
  border-radius: 20px !important;
  padding: 16px 20px !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.modern-timeline-item:hover .timeline-content {
  background: rgba(255, 255, 255, 0.35) !important;
}

/* Timeline Header */
.timeline-header {
  margin-bottom: 8px !important;
}

.timeline-meta {
  display: flex !important;
  justify-content: space-between !important;
  align-items: center !important;
}

.timeline-time {
  font-size: 11px !important;
  color: var(--ui-text-secondary) !important;
  opacity: 0.8 !important;
  font-weight: 500 !important;
}

.timeline-module {
  font-size: 12px !important;
  font-weight: 600 !important;
  color: var(--ui-accent) !important;
  background: rgba(77, 110, 245, 0.1) !important;
  padding: 4px 8px !important;
  border-radius: 6px !important;
}

/* Timeline Body */
.timeline-body {
  display: flex !important;
  flex-direction: column !important;
  gap: 4px !important;
}

.activity-title {
  font-size: 14px !important;
  font-weight: 600 !important;
  color: var(--ui-text) !important;
  line-height: 1.3 !important;
}

.activity-description {
  font-size: 12px !important;
  color: var(--ui-text-secondary) !important;
  opacity: 0.9 !important;
  line-height: 1.4 !important;
}

/* Empty State */
.empty-state .timeline-icon-wrapper {
  background: linear-gradient(135deg, var(--ui-text-secondary) 0%, rgba(107, 113, 120, 0.8) 100%) !important;
  box-shadow: 0 4px 12px rgba(107, 113, 120, 0.2) !important;
}

/* Responsive Design */
@media (max-width: 768px) {
  .modern-actions-container,
  .modern-activities-container {
    margin: 15px 10px !important;
    border-radius: 16px !important;
  }
  
  .action-icon-wrapper,
  .timeline-icon-wrapper {
    width: 40px !important;
    height: 40px !important;
  }
  
  .action-icon,
  .timeline-icon {
    font-size: 14px !important;
  }
  
  .action-title,
  .activity-title {
    font-size: 13px !important;
  }
  
  .modern-timeline::before {
    left: 20px !important;
  }
}

/* Animation Enhancement */
.action-item {
  animation: slideInFromRight 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards !important;
  animation-delay: calc(var(--index, 0) * 0.1s) !important;
}

.modern-timeline-item {
  animation: slideInFromLeft 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards !important;
  animation-delay: calc(var(--index, 0) * 0.15s) !important;
}

/* ========================================== */
/* PROJECT WORKFLOW STATUS - MODERN UI 2025 */
/* ========================================== */

/* Main Container */
.modern-workflow-container {
  background: rgba(255, 255, 255, 0.35) !important;
  backdrop-filter: blur(25px) !important;
  -webkit-backdrop-filter: blur(25px) !important;
  border: none !important;
  border-radius: 24px !important;
  box-shadow: 
    0 12px 40px rgba(0, 0, 0, 0.15),
    0 4px 20px rgba(0, 0, 0, 0.08) !important;
  overflow: hidden !important;
  margin-bottom: 25px !important;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.modern-workflow-container:hover {
  transform: translateY(-2px) !important;
  box-shadow: 
    0 20px 40px rgba(0, 0, 0, 0.15),
    0 4px 24px rgba(0, 0, 0, 0.08),
    inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
}

/* Header */
.modern-workflow-container .box-header {
  background: linear-gradient(135deg, rgba(77, 110, 245, 0.2) 0%, rgba(107, 126, 247, 0.15) 100%) !important;
  border-bottom: none !important;
  padding: 20px 25px !important;
}

.workflow-status-indicator {
  display: flex !important;
  align-items: center !important;
  padding: 6px 12px !important;
  background: rgba(77, 110, 245, 0.1) !important;
  border-radius: 20px !important;
  border: 1px solid rgba(77, 110, 245, 0.2) !important;
}

/* Modern Workflow Wrapper */
.modern-workflow-wrapper {
  padding: 0 !important;
  background: transparent !important;
}

.modern-workflow-container .modern-workflow-container {
  background: rgba(255, 255, 255, 0.25) !important;
  border-radius: 20px !important;
  margin: 20px !important;
  overflow: hidden !important;
  border: none !important;
}

/* Modern Workflow Table */
.modern-workflow-table {
  width: 100% !important;
  border-collapse: separate !important;
  border-spacing: 0 !important;
  background: transparent !important;
}

/* Modern Table Headers */
.modern-workflow-thead {
  background: linear-gradient(135deg, rgba(107, 113, 120, 0.1) 0%, rgba(77, 110, 245, 0.05) 100%) !important;
}

.modern-workflow-thead th {
  padding: 18px 16px !important;
  font-weight: 600 !important;
  font-size: 12px !important;
  text-transform: uppercase !important;
  letter-spacing: 0.5px !important;
  color: var(--ui-text-secondary) !important;
  border: none !important;
  position: relative !important;
}

.project-id-header,
.description-header {
  text-align: left !important;
  color: var(--ui-text) !important;
}

.metric-header,
.progress-header,
.status-header,
.date-header {
  text-align: center !important;
}

/* Modern Table Rows */
.modern-workflow-tbody .workflow-row {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
  background: transparent !important;
}

.modern-workflow-tbody .workflow-row:hover {
  background: linear-gradient(135deg, rgba(77, 110, 245, 0.08) 0%, rgba(63, 185, 132, 0.05) 100%) !important;
  transform: translateX(4px) !important;
}

.modern-workflow-tbody .workflow-row:last-child {
  border-bottom: none !important;
}

/* Project Info Cell */
.project-id-cell {
  padding: 16px !important;
  border: none !important;
}

.project-info {
  display: flex !important;
  align-items: center !important;
  gap: 12px !important;
}

.project-icon-wrapper {
  width: 36px !important;
  height: 36px !important;
  background: linear-gradient(135deg, var(--ui-accent) 0%, rgba(77, 110, 245, 0.8) 100%) !important;
  border-radius: 10px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  box-shadow: 0 3px 10px rgba(77, 110, 245, 0.3) !important;
}

.project-icon {
  color: white !important;
  font-size: 14px !important;
}

.project-details {
  display: flex !important;
  flex-direction: column !important;
  gap: 2px !important;
}

.project-name {
  font-weight: 600 !important;
  font-size: 14px !important;
  color: var(--ui-text) !important;
  line-height: 1.2 !important;
}

.project-subtitle {
  font-size: 11px !important;
  color: var(--ui-text-secondary) !important;
  opacity: 0.8 !important;
}

/* Description Cell */
.description-cell {
  padding: 16px !important;
  border: none !important;
  max-width: 200px !important;
}

.description-content {
  font-size: 13px !important;
  color: var(--ui-text-secondary) !important;
  line-height: 1.4 !important;
  overflow: hidden !important;
  text-overflow: ellipsis !important;
  display: -webkit-box !important;
  -webkit-line-clamp: 2 !important;
  -webkit-box-orient: vertical !important;
}

/* Metric Cells */
.metric-cell {
  padding: 16px 12px !important;
  text-align: center !important;
  border: none !important;
}

.modern-badge {
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  gap: 2px !important;
  padding: 6px 8px !important;
  border-radius: 8px !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  cursor: default !important;
}

.modern-badge:hover {
  transform: translateY(-1px) !important;
}

.samples-badge:hover {
  background: rgba(77, 110, 245, 0.1) !important;
  box-shadow: 0 3px 10px rgba(77, 110, 245, 0.15) !important;
}

.tests-badge:hover {
  background: rgba(245, 192, 77, 0.1) !important;
  box-shadow: 0 3px 10px rgba(245, 192, 77, 0.15) !important;
}

.completed-badge:hover {
  background: rgba(63, 185, 132, 0.1) !important;
  box-shadow: 0 3px 10px rgba(63, 185, 132, 0.15) !important;
}

.badge-value {
  font-size: 16px !important;
  font-weight: 700 !important;
  color: var(--ui-text) !important;
  line-height: 1 !important;
}

.samples-badge .badge-value {
  color: var(--ui-accent) !important;
}

.tests-badge .badge-value {
  color: var(--ui-warning) !important;
}

.completed-badge .badge-value {
  color: var(--ui-success) !important;
}

.badge-label {
  font-size: 10px !important;
  font-weight: 500 !important;
  color: var(--ui-text-secondary) !important;
  text-transform: uppercase !important;
  letter-spacing: 0.5px !important;
}

/* Progress Cell */
.progress-cell {
  padding: 16px 12px !important;
  text-align: center !important;
  border: none !important;
}

.modern-progress-wrapper {
  display: flex !important;
  flex-direction: column !important;
  gap: 6px !important;
  align-items: center !important;
}

.progress-info {
  display: flex !important;
  align-items: center !important;
  gap: 6px !important;
}

.progress-percentage {
  font-size: 14px !important;
  font-weight: 700 !important;
  line-height: 1 !important;
}

.progress-status-icon {
  font-size: 12px !important;
  opacity: 0.8 !important;
}

.modern-progress-track {
  width: 70px !important;
  height: 5px !important;
  position: relative !important;
  border-radius: 8px !important;
  overflow: hidden !important;
}

.progress-track-bg {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  background: rgba(107, 113, 120, 0.15) !important;
  border-radius: 8px !important;
}

.progress-fill-modern {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  height: 100% !important;
  border-radius: 8px !important;
  transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1) !important;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2) !important;
}

/* Status Cell */
.status-cell {
  padding: 16px 12px !important;
  text-align: center !important;
  border: none !important;
}

.modern-status-badge {
  display: inline-flex !important;
  align-items: center !important;
  gap: 6px !important;
  padding: 8px 12px !important;
  border-radius: 12px !important;
  font-size: 12px !important;
  font-weight: 500 !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.modern-status-badge:hover {
  transform: translateY(-1px) !important;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
}

.status-icon {
  font-size: 11px !important;
}

.status-text {
  font-weight: 600 !important;
}

/* Date Cell */
.date-cell {
  padding: 16px 12px !important;
  text-align: center !important;
  border: none !important;
}

.date-info {
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  gap: 2px !important;
}

.date-value {
  font-size: 12px !important;
  font-weight: 500 !important;
  color: var(--ui-text) !important;
}

.date-label {
  font-size: 10px !important;
  color: var(--ui-text-secondary) !important;
  text-transform: uppercase !important;
  letter-spacing: 0.3px !important;
}

/* Empty State */
.empty-state-row {
  background: transparent !important;
}

.empty-state-cell {
  padding: 40px 20px !important;
  text-align: center !important;
  border: none !important;
}

.empty-state-content {
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  gap: 8px !important;
}

.empty-state-icon {
  font-size: 32px !important;
  color: var(--ui-text-secondary) !important;
  opacity: 0.5 !important;
}

.empty-state-title {
  font-size: 16px !important;
  font-weight: 600 !important;
  color: var(--ui-text) !important;
}

.empty-state-subtitle {
  font-size: 13px !important;
  color: var(--ui-text-secondary) !important;
  opacity: 0.8 !important;
}

/* Responsive Design */
@media (max-width: 768px) {
  .modern-workflow-container {
    margin: 15px 10px !important;
    border-radius: 16px !important;
  }
  
  .modern-workflow-container .modern-workflow-container {
    margin: 15px !important;
    border-radius: 12px !important;
  }
  
  .project-info {
    gap: 8px !important;
  }
  
  .project-icon-wrapper {
    width: 32px !important;
    height: 32px !important;
  }
  
  .project-name {
    font-size: 13px !important;
  }
  
  .badge-value {
    font-size: 14px !important;
  }
  
  .modern-progress-track {
    width: 50px !important;
  }
}

/* Animation Enhancement */
.workflow-row[data-index]:nth-child(odd) {
  animation: slideInFromLeft 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards !important;
  animation-delay: calc(var(--index, 0) * 0.05s) !important;
}

.workflow-row[data-index]:nth-child(even) {
  animation: slideInFromRight 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards !important;
  animation-delay: calc(var(--index, 0) * 0.05s) !important;
}
</style>

<div class="content-wrapper dashboard-container">
    <section class="content">
        <!-- Welcome Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="box modern-welcome-header">
                    <div class="box-header with-border">
                        <div class="welcome-header-layout">
                            <div class="welcome-left-section">
                                <div class="welcome-icon-wrapper">
                                    <i class="fa fa-dashboard welcome-icon"></i>
                                </div>
                                <div class="welcome-text-content">
                                    <h1 class="welcome-main-title">One Water LIMS Dashboard</h1>
                                    <p class="welcome-subtitle">Laboratory Information Management System</p>
                                </div>
                            </div>
                            <div class="welcome-right-section">
                                <div class="welcome-user-badge">
                                    <i class="fa fa-user user-badge-icon"></i>
                                    <span>Welcome, <?php echo $this->session->userdata('full_name'); ?>!</span>
                                </div>
                                <div class="welcome-user-badge">
                                    <i class="fa fa-clock-o time-badge-icon"></i>
                                    <span id="current-time"><?php echo date('H:i'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-lg-3 col-xs-6 card-aqua">
                <a href="#" style="text-decoration: none; color: inherit;">
                    <div class="modern-summary-card card-animate-1">
                        <div class="card-content-wrapper">
                            <div class="card-info">
                                <h3 class="card-number"><?php echo number_format($summary['total_projects'] ?? 0); ?></h3>
                                <p class="card-label">Total Projects</p>
                            </div>
                            <div class="card-icon-wrapper">
                                <i class="fa fa-folder-open card-icon"></i>
                            </div>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-xs-6 card-green">
                <a href="#" style="text-decoration: none; color: inherit;">
                    <div class="modern-summary-card card-animate-2">
                        <div class="card-content-wrapper">
                            <div class="card-info">
                                <h3 class="card-number"><?php echo number_format($summary['total_samples'] ?? 0); ?></h3>
                                <p class="card-label">Total Samples</p>
                            </div>
                            <div class="card-icon-wrapper">
                                <i class="fa fa-flask card-icon"></i>
                            </div>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-xs-6 card-yellow">
                <a href="#" style="text-decoration: none; color: inherit;">
                    <div class="modern-summary-card card-animate-3">
                        <div class="card-content-wrapper">
                            <div class="card-info">
                                <h3 class="card-number"><?php echo number_format($summary['total_tests'] ?? 0); ?></h3>
                                <p class="card-label">Total Tests</p>
                            </div>
                            <div class="card-icon-wrapper">
                                <i class="fa fa-bar-chart card-icon"></i>
                            </div>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-xs-6 card-red">
                <a href="#" style="text-decoration: none; color: inherit;">
                    <div class="modern-summary-card card-animate-4">
                        <div class="card-content-wrapper">
                            <div class="card-info">
                                <h3 class="card-number"><?php echo number_format($summary['projects_today'] ?? 0); ?></h3>
                                <p class="card-label">New Projects Today</p>
                            </div>
                            <div class="card-icon-wrapper">
                                <i class="fa fa-plus-circle card-icon"></i>
                            </div>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Main Content Row -->
        <div class="row">
            <div class="col-md-8">
                <!-- Monthly Trends Chart -->
                <div class="box box-primary chart-container">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-line-chart" style="color: #4D6EF5; margin-right: 8px;"></i> 
                            <span style="font-weight: 600; letter-spacing: -0.3px;">Analytics Dashboard</span>
                        </h3>
                        <div class="box-tools pull-right">
                            <div class="form-group" style="margin: 0; display: flex; align-items: center;">
                                <span class="year-selector-label">Year</span>
                                <select id="year_selector" class="form-control">
                                    <?php if (!empty($available_years)): ?>
                                        <?php foreach ($available_years as $year): ?>
                                            <option value="<?php echo $year; ?>" <?php echo ($year == date('Y')) ? 'selected' : ''; ?>>
                                                <?php echo $year; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="<?php echo date('Y'); ?>" selected><?php echo date('Y'); ?></option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="monthly_chart"></div>
                        <div id="chart_loading" style="display: none; text-align: center;">
                            <i class="fa fa-spinner fa-spin fa-2x"></i>
                            <p>Loading analytics data...</p>
                        </div>
                    </div>
                </div>

                <!-- Module Performance Overview -->
                <div class="box box-info chart-container">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-dashboard" style="color: #4D6EF5; margin-right: 8px;"></i>
                            <span style="font-weight: 600; letter-spacing: -0.3px;">Performance Metrics</span>
                        </h3>
                        <div class="box-tools pull-right">
                            <span class="workflow-status-indicator">
                                <i class="fa fa-circle" style="color: #4D6EF5; font-size: 8px; margin-right: 5px;"></i>
                                <span style="font-size: 12px; color: #6B7178; font-weight: 500;">Live Data</span>
                            </span>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="modern-table-wrapper">
                            <div class="modern-table-container">
                                <table class="modern-performance-table">
                                    <thead class="modern-performance-thead">
                                        <tr>
                                            <th class="module-name-header">Module</th>
                                            <th class="metric-header">Total</th>
                                            <th class="metric-header">Completed</th>
                                            <th class="metric-header">Pending</th>
                                            <th class="progress-header">Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody class="modern-performance-tbody">
                                        <?php if (!empty($module_statistics)): ?>
                                            <?php foreach ($module_statistics as $index => $module): ?>
                                                <tr class="module-row" data-index="<?php echo $index; ?>">
                                                    <td class="module-name-cell">
                                                        <div class="module-info">
                                                            <div class="module-icon-wrapper">
                                                                <i class="fa fa-cube module-icon"></i>
                                                            </div>
                                                            <div class="module-details">
                                                                <span class="module-name"><?php echo htmlspecialchars($module['module']); ?></span>
                                                                <span class="module-subtitle"><?php echo isset($module['table']) ? $module['table'] : 'Testing Module'; ?></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="metric-cell">
                                                        <div class="modern-metric total-metric">
                                                            <span class="metric-value"><?php echo number_format($module['total']); ?></span>
                                                            <span class="metric-label">items</span>
                                                        </div>
                                                    </td>
                                                    <td class="metric-cell">
                                                        <div class="modern-metric completed-metric">
                                                            <span class="metric-value success-color"><?php echo number_format($module['completed']); ?></span>
                                                            <span class="metric-label">done</span>
                                                        </div>
                                                    </td>
                                                    <td class="metric-cell">
                                                        <div class="modern-metric pending-metric" 
                                                             data-module="<?php echo htmlspecialchars($module['module']); ?>"
                                                             title="Click to view pending items">
                                                            <span class="metric-value warning-color"><?php echo number_format($module['pending']); ?></span>
                                                            <span class="metric-label">pending</span>
                                                        </div>
                                                    </td>
                                                    <td class="progress-cell">
                                                        <?php
                                                        $module_completion = $module['completion_rate'];
                                                        if ($module_completion >= 100) {
                                                            $progress_color = '#3FB984'; // Green
                                                            $progress_status = 'Complete';
                                                            $progress_icon = 'fa-check-circle';
                                                        } elseif ($module_completion >= 80) {
                                                            $progress_color = '#4D6EF5'; // Blue  
                                                            $progress_status = 'Almost Done';
                                                            $progress_icon = 'fa-clock-o';
                                                        } elseif ($module_completion >= 50) {
                                                            $progress_color = '#F5C04D'; // Yellow
                                                            $progress_status = 'In Progress';
                                                            $progress_icon = 'fa-hourglass-half';
                                                        } else {
                                                            $progress_color = '#E05B5B'; // Red
                                                            $progress_status = 'Starting';
                                                            $progress_icon = 'fa-play-circle';
                                                        }
                                                        ?>
                                                        <div class="modern-progress-container">
                                                            <div class="progress-info">
                                                                <span class="progress-percentage" style="color: <?php echo $progress_color; ?>">
                                                                    <?php echo $module_completion; ?>%
                                                                </span>
                                                                <i class="fa <?php echo $progress_icon; ?> progress-status-icon" 
                                                                   style="color: <?php echo $progress_color; ?>"
                                                                   title="<?php echo $progress_status; ?>"></i>
                                                            </div>
                                                            <div class="modern-progress-bar">
                                                                <div class="progress-track"></div>
                                                                <div class="progress-fill" 
                                                                     style="width: <?php echo $module_completion; ?>%; background: linear-gradient(90deg, rgba(<?php echo $progress_color === '#3FB984' ? '63, 185, 132' : ($progress_color === '#4D6EF5' ? '77, 110, 245' : ($progress_color === '#F5C04D' ? '245, 192, 77' : '224, 91, 91')); ?>, 0.3) 0%, <?php echo $progress_color; ?> 100%);"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No module data available</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <div class="col-md-4">
                <!-- Quick Actions -->
                <div class="box box-success chart-container">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-rocket" style="color: #4D6EF5; margin-right: 8px;"></i>
                            <span style="font-weight: 600; letter-spacing: -0.3px;">Quick Actions</span>
                        </h3>
                        <div class="box-tools pull-right">
                            <span class="workflow-status-indicator">
                                <i class="fa fa-circle" style="color: #4D6EF5; font-size: 8px; margin-right: 5px;"></i>
                                <span style="font-size: 12px; color: #6B7178; font-weight: 500;">Ready</span>
                            </span>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="modern-actions-grid">
                            <div class="action-item">
                                <a href="<?php echo site_url('sample_reception?new_modal=1'); ?>" class="modern-action-btn primary-action">
                                    <div class="action-icon-wrapper">
                                        <i class="fa fa-plus action-icon"></i>
                                    </div>
                                    <div class="action-content">
                                        <span class="action-title">New Project</span>
                                        <span class="action-subtitle">Create new sample project</span>
                                    </div>
                                    <div class="action-arrow">
                                        <i class="fa fa-chevron-right"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="box box-warning chart-container">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <!-- <i class="fa fa-clock-o"></i>
                            <span>Recent Activities</span> -->
                            <i class="fa fa-clock-o" style="color: #4D6EF5; margin-right: 8px;"></i>
                            <span style="font-weight: 600; letter-spacing: -0.3px;">Recent Activities</span>
                        </h3>
                    </div>
                    <div class="box-body">
                        <ul class="timeline timeline-inverse">
                            <?php if (!empty($recent_activities)): ?>
                                <?php foreach ($recent_activities as $index => $activity): ?>
                                    <li class="modern-timeline-item" data-index="<?php echo $index; ?>">
                                        <div class="timeline-icon-wrapper">
                                            <i class="fa <?php echo $activity['icon']; ?> timeline-icon"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="timeline-header">
                                                <div class="timeline-meta">
                                                    <span class="timeline-time">
                                                        <i class="fa fa-clock-o"></i> 
                                                        <?php echo date('H:i', strtotime($activity['date'])); ?>
                                                    </span>
                                                    <span class="timeline-module"><?php echo htmlspecialchars($activity['module']); ?></span>
                                                </div>
                                            </div>
                                            <div class="timeline-body">
                                                <div class="activity-title"><?php echo htmlspecialchars($activity['action']); ?></div>
                                                <div class="activity-description"><?php echo htmlspecialchars($activity['description']); ?></div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="modern-timeline-item empty-state">
                                    <div class="timeline-icon-wrapper">
                                        <i class="fa fa-info timeline-icon"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-body">
                                            <div class="activity-title">No recent activities</div>
                                            <div class="activity-description">Activities will appear here when available</div>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
 

        <!-- Workflow Status -->
        <div class="row">
            <div class="col-md-12" style="padding-left: 15px; padding-right: 15px;">
                <div class="box box-solid chart-container">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-sitemap" style="color: #4D6EF5; margin-right: 8px;"></i>
                            <span style="font-weight: 600; letter-spacing: -0.3px;">Project Workflow Status</span>
                        </h3>
                        <div class="box-tools pull-right">
                            <span class="workflow-status-indicator">
                                <i class="fa fa-circle" style="color: #4D6EF5; font-size: 8px; margin-right: 5px;"></i>
                                <span style="font-size: 12px; color: #6B7178; font-weight: 500;">Active Projects</span>
                            </span>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="modern-workflow-wrapper">
                            <div class="modern-workflow-container">
                                <table id="workflow-table" class="modern-workflow-table">
                                <thead class="modern-workflow-thead">
                                    <tr>
                                        <th class="project-id-header">Project ID</th>
                                        <th class="description-header">Description</th>
                                        <th class="metric-header">Samples</th>
                                        <th class="metric-header">Tests</th>
                                        <th class="metric-header">Completed</th>
                                        <th class="progress-header">Progress</th>
                                        <th class="status-header">Status</th>
                                        <th class="date-header">Date Created</th>
                                    </tr>
                                </thead>
                                <tbody class="modern-workflow-tbody">
                                    <?php if (!empty($workflow_status)): ?>
                                        <?php foreach ($workflow_status as $index => $workflow): ?>
                                            <tr class="workflow-row" data-index="<?php echo $index; ?>">
                                                <td class="project-id-cell">
                                                    <div class="project-info">
                                                        <div class="project-icon-wrapper">
                                                            <i class="fa fa-folder-open project-icon"></i>
                                                        </div>
                                                        <div class="project-details">
                                                            <span class="project-name"><?php echo htmlspecialchars($workflow['project_id']); ?></span>
                                                            <span class="project-subtitle">Project</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="description-cell">
                                                    <div class="description-content">
                                                        <?php echo htmlspecialchars($workflow['description'] ?? 'No description'); ?>
                                                    </div>
                                                </td>
                                                <td class="metric-cell">
                                                    <div class="modern-badge samples-badge">
                                                        <span class="badge-value"><?php echo $workflow['total_samples']; ?></span>
                                                        <span class="badge-label">samples</span>
                                                    </div>
                                                </td>
                                                <td class="metric-cell">
                                                    <div class="modern-badge tests-badge">
                                                        <span class="badge-value"><?php echo $workflow['total_tests']; ?></span>
                                                        <span class="badge-label">tests</span>
                                                    </div>
                                                </td>
                                                <td class="metric-cell">
                                                    <div class="modern-badge completed-badge">
                                                        <span class="badge-value"><?php echo $workflow['completed_tests']; ?></span>
                                                        <span class="badge-label">done</span>
                                                    </div>
                                                </td>
                                                <td class="progress-cell">
                                                    <?php
                                                    $completion_rate = $workflow['completion_rate'];
                                                    if ($completion_rate >= 100) {
                                                        $progress_color = '#3FB984';
                                                        $progress_status = 'Complete';
                                                        $progress_icon = 'fa-check-circle';
                                                    } elseif ($completion_rate >= 80) {
                                                        $progress_color = '#4D6EF5';
                                                        $progress_status = 'Almost Done';
                                                        $progress_icon = 'fa-clock-o';
                                                    } elseif ($completion_rate >= 50) {
                                                        $progress_color = '#F5C04D';
                                                        $progress_status = 'In Progress';
                                                        $progress_icon = 'fa-hourglass-half';
                                                    } else {
                                                        $progress_color = '#E05B5B';
                                                        $progress_status = 'Starting';
                                                        $progress_icon = 'fa-play-circle';
                                                    }
                                                    ?>
                                                    <div class="modern-progress-wrapper">
                                                        <div class="progress-info">
                                                            <span class="progress-percentage" style="color: <?php echo $progress_color; ?>">
                                                                <?php echo $completion_rate; ?>%
                                                            </span>
                                                            <i class="fa <?php echo $progress_icon; ?> progress-status-icon" 
                                                               style="color: <?php echo $progress_color; ?>"
                                                               title="<?php echo $progress_status; ?>"></i>
                                                        </div>
                                                        <div class="modern-progress-track">
                                                            <div class="progress-track-bg"></div>
                                                            <div class="progress-fill-modern" 
                                                                 style="width: <?php echo $completion_rate; ?>%; background: linear-gradient(90deg, rgba(<?php echo $progress_color === '#3FB984' ? '63, 185, 132' : ($progress_color === '#4D6EF5' ? '77, 110, 245' : ($progress_color === '#F5C04D' ? '245, 192, 77' : '224, 91, 91')); ?>, 0.3) 0%, <?php echo $progress_color; ?> 100%);"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="status-cell">
                                                    <?php 
                                                    if ($completion_rate >= 100) {
                                                        $status_color = '#3FB984';
                                                        $status_text = 'Complete';
                                                        $status_icon = 'fa-check-circle';
                                                    } elseif ($completion_rate >= 80) {
                                                        $status_color = '#4D6EF5';
                                                        $status_text = 'Almost Done';
                                                        $status_icon = 'fa-clock-o';
                                                    } elseif ($completion_rate >= 50) {
                                                        $status_color = '#F5C04D';
                                                        $status_text = 'In Progress';
                                                        $status_icon = 'fa-hourglass-half';
                                                    } elseif ($completion_rate > 0) {
                                                        $status_color = '#E05B5B';
                                                        $status_text = 'In Progress';
                                                        $status_icon = 'fa-exclamation-triangle';
                                                    } else {
                                                        $status_color = '#6B7178';
                                                        $status_text = 'No Tests';
                                                        $status_icon = 'fa-minus-circle';
                                                    }
                                                    ?>
                                                    <div class="modern-status-badge" style="background: <?php echo $status_color; ?>10; border: 1px solid <?php echo $status_color; ?>30;">
                                                        <i class="fa <?php echo $status_icon; ?> status-icon" style="color: <?php echo $status_color; ?>"></i>
                                                        <span class="status-text" style="color: <?php echo $status_color; ?>"><?php echo $status_text; ?></span>
                                                    </div>
                                                </td>
                                                <td class="date-cell">
                                                    <div class="date-info">
                                                        <span class="date-value"><?php echo !empty($workflow['date_created']) ? date('M j, Y', strtotime($workflow['date_created'])) : '-'; ?></span>
                                                        <span class="date-label">created</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="empty-state-row">
                                            <td colspan="8" class="empty-state-cell">
                                                <div class="empty-state-content">
                                                    <i class="fa fa-inbox empty-state-icon"></i>
                                                    <span class="empty-state-title">No workflow data available</span>
                                                    <span class="empty-state-subtitle">Projects will appear here when created</span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<!-- Modal for Pending Items Detail -->
<div class="modal fade" id="pendingModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f39c12; color: white;">
                <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                <h4 class="modal-title">
                    <i class="fa fa-clock-o"></i> Pending Items - <span id="modalModuleName"></span>
                </h4>
            </div>
            <div class="modal-body" style="height: 75vh; padding: 0;">
                <div id="pendingItemsLoader" class="modern-loader">
                    <div class="loader-animation">
                        <div class="pulse-loader"></div>
                        <div class="pulse-loader pulse-delay-1"></div>
                        <div class="pulse-loader pulse-delay-2"></div>
                    </div>
                    <p class="loader-text">Loading pending items...</p>
                </div>
                <div id="pendingItemsContent" style="display: none; height: 100%; display: flex; flex-direction: column;">
                    <!-- Modern Summary Info Bar -->
                    <!-- <div class="modern-info-bar">
                        <div class="info-content">
                            <div class="info-badge">
                                <span id="pendingItemsCount">0</span>
                            </div>
                            <span class="info-text">pending items found</span>
                        </div>
                    </div> -->
                    <!-- Modern Scrollable Table Container -->
                    <div class="modern-table-container" style="height: 100%; overflow-y: auto; overflow-x: auto;">
                        <table class="modern-table" id="pendingItemsTable">
                            <thead class="modern-thead">
                                <tr>
                                    <th class="modern-th">Project ID</th>
                                    <th class="modern-th">Sample ID</th>
                                    <!-- <th class="modern-th">Client</th> -->
                                    <th class="modern-th">Date Created</th>
                                    <!-- <th class="text-center">Action</th> -->
                                </tr>
                            </thead>
                            <tbody id="pendingItemsTableBody" class="modern-tbody">
                                <!-- Data will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="pendingItemsError" style="display: none;" class="alert alert-danger" style="margin: 20px;">
                    <i class="fa fa-exclamation-triangle"></i> 
                    <strong>Error:</strong> Failed to load pending items. Please try again.
                    <button type="button" class="btn btn-sm btn-warning pull-right" onclick="$('.pending-metric').first().click();">
                        <i class="fa fa-refresh"></i> Retry
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    <small class="text-muted">
                        <i class="fa fa-info-circle"></i> 
                        Last updated: <span id="lastUpdatedTime"></span>
                    </small>
                </div>
                <div class="pull-right">
                    <!-- <button type="button" class="btn btn-warning btn-sm" onclick="$('.pending-metric[data-module=\"' + $('#modalModuleName').text() + '\"]').click();" title="Refresh data">
                        <i class="fa fa-refresh"></i> Refresh
                    </button> -->
                    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/highcharts.js') ?>"></script>
<script src="<?php echo base_url('assets/js/exporting.js') ?>"></script>

<script>
$(document).ready(function() {
    // Initialize monthly trends chart
    var monthlyChart;
    
    function loadMonthlyChart(year) {
        if (!year) {
            year = <?php echo date('Y'); ?>;
        }
        
        // Show loading indicator
        $('#monthly_chart').hide();
        $('#chart_loading').show();
        
        $.ajax({
            url: '<?php echo site_url("welcome/get_monthly_statistics_by_year"); ?>',
            type: 'POST',
            data: { year: year },
            dataType: 'json',
            success: function(response) {
                if (response.success && response.data) {
                    var categories = [];
                    var projectsData = [];
                    var samplesData = [];
                    var testsData = [];
                    
                    $.each(response.data, function(index, month) {
                        categories.push(month.month);
                        projectsData.push(parseInt(month.projects));
                        samplesData.push(parseInt(month.samples));
                        testsData.push(parseInt(month.tests || 0));
                    });
                    
                    // Destroy existing chart if exists
                    if (monthlyChart) {
                        monthlyChart.destroy();
                    }
                    
                    // Create new chart with modern UI 2025 styling
                    monthlyChart = Highcharts.chart('monthly_chart', {
                        chart: {
                            type: 'spline',
                            backgroundColor: 'transparent',
                            borderRadius: 16,
                            spacing: [20, 20, 20, 20],
                            style: {
                                fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif'
                            }
                        },
                        title: {
                            text: 'Monthly Analytics Overview',
                            align: 'left',
                            style: {
                                fontSize: '20px',
                                fontWeight: '600',
                                color: '#1A1D21',
                                letterSpacing: '-0.5px'
                            },
                            margin: 25
                        },
                        subtitle: {
                            text: 'Projects, Samples & Tests for ' + year,
                            align: 'left',
                            style: {
                                fontSize: '14px',
                                fontWeight: '400',
                                color: '#6B7178',
                                marginTop: '5px'
                            }
                        },
                        xAxis: {
                            categories: categories,
                            lineWidth: 0,
                            tickWidth: 0,
                            labels: {
                                style: {
                                    fontSize: '12px',
                                    fontWeight: '500',
                                    color: '#6B7178'
                                },
                                y: 20
                            },
                            gridLineWidth: 0
                        },
                        yAxis: {
                            title: {
                                text: null
                            },
                            gridLineColor: '#F1F3F5',
                            gridLineWidth: 1,
                            lineWidth: 0,
                            tickWidth: 0,
                            labels: {
                                style: {
                                    fontSize: '12px',
                                    fontWeight: '500',
                                    color: '#6B7178'
                                },
                                x: -10
                            }
                        },
                        legend: {
                            align: 'left',
                            verticalAlign: 'top',
                            y: 45,
                            x: 0,
                            itemStyle: {
                                fontSize: '13px',
                                fontWeight: '500',
                                color: '#1A1D21'
                            },
                            itemHoverStyle: {
                                color: '#4D6EF5'
                            },
                            itemDistance: 30,
                            symbolRadius: 6,
                            symbolHeight: 12,
                            symbolWidth: 12
                        },
                        tooltip: {
                            shared: true,
                            backgroundColor: '#FFFFFF',
                            borderColor: '#E2E4E8',
                            borderRadius: 12,
                            borderWidth: 1,
                            shadow: {
                                color: 'rgba(0,0,0,0.1)',
                                offsetX: 0,
                                offsetY: 4,
                                opacity: 0.15,
                                width: 12
                            },
                            style: {
                                fontSize: '13px',
                                fontWeight: '500'
                            },
                            headerFormat: '<div style=\"font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #1A1D21;\">{point.key}</div>',
                            pointFormat: '<div style=\"margin: 4px 0;\"><span style=\"color: {series.color}; font-size: 16px;\">●</span> <span style=\"font-weight: 500; color: #1A1D21;\">{series.name}:</span> <span style=\"font-weight: 600; color: {series.color};\">{point.y:,.0f}</span></div>',
                            footerFormat: '',
                            useHTML: true,
                            padding: 16
                        },
                        plotOptions: {
                            spline: {
                                lineWidth: 3,
                                states: {
                                    hover: {
                                        lineWidth: 4
                                    }
                                },
                                marker: {
                                    enabled: true,
                                    radius: 5,
                                    symbol: 'circle',
                                    lineWidth: 2,
                                    lineColor: '#FFFFFF',
                                    states: {
                                        hover: {
                                            enabled: true,
                                            radius: 7,
                                            lineWidth: 3
                                        }
                                    }
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                enableMouseTracking: true
                            }
                        },
                        series: [{
                            name: 'Projects',
                            color: '#4D6EF5',
                            data: projectsData,
                            zIndex: 3
                        }, {
                            name: 'Samples',
                            color: '#3FB984',
                            data: samplesData,
                            zIndex: 2
                        }, {
                            name: 'Tests',
                            color: '#F5C04D',
                            data: testsData,
                            zIndex: 1
                        }],
                        credits: {
                            enabled: false
                        },
                        responsive: {
                            rules: [{
                                condition: {
                                    maxWidth: 500
                                },
                                chartOptions: {
                                    chart: {
                                        spacing: [10, 10, 10, 10]
                                    },
                                    title: {
                                        style: {
                                            fontSize: '16px'
                                        }
                                    },
                                    subtitle: {
                                        style: {
                                            fontSize: '12px'
                                        }
                                    },
                                    legend: {
                                        layout: 'horizontal',
                                        align: 'center',
                                        verticalAlign: 'bottom',
                                        itemDistance: 15
                                    }
                                }
                            }]
                        }
                    });
                    
                    // Hide loading and show chart
                    $('#chart_loading').hide();
                    $('#monthly_chart').show();
                } else {
                    $('#chart_loading').hide();
                    $('#monthly_chart').html('<div class="alert alert-warning text-center">Failed to load chart data for ' + year + '</div>').show();
                }
            },
            error: function() {
                $('#chart_loading').hide();
                $('#monthly_chart').html('<div class="alert alert-danger text-center">Error loading chart data</div>').show();
            }
        });
    }
    
    // Load initial chart with current year
    loadMonthlyChart(<?php echo date('Y'); ?>);
    
    // Handle year selector change
    $('#year_selector').on('change', function() {
        var selectedYear = $(this).val();
        loadMonthlyChart(selectedYear);
    });

    // Initialize DataTables for workflow status table
    $('#workflow-table').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "paging": true,
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50, 100],
        "language": {
            "search": "Search Project:",
            "lengthMenu": "Show _MENU_ projects per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ projects",
            "infoEmpty": "No projects available",
            "infoFiltered": "(filtered from _MAX_ total projects)",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            }
        },
        "columnDefs": [
            { "orderable": false, "targets": [5] }, // Disable ordering for Progress column (contains HTML)
            { "className": "text-center", "targets": [2, 3, 4, 5, 6, 7] } // Center align specified columns
        ],
        "order": [], // No default sorting - preserve database order
        "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "drawCallback": function() {
            // Re-initialize tooltips after table redraw
            $('.progress').tooltip({
                // title: 'Click to view details',
                placement: 'top'
            });
        }
    });

    // Auto-refresh dashboard data every 5 minutes
    setInterval(function() {
        location.reload();
    }, 300000);

    // Add tooltips to progress bars
    $('.progress').each(function() {
        $(this).tooltip({
            // title: 'Click to view details',
            placement: 'top'
        });
    });

    // Handle pending metric click
    $('.pending-metric').on('click', function() {
        var module = $(this).data('module');
        var pendingCount = $(this).find('.metric-value').text().trim();
        if (pendingCount === '0') {
            return; // Don't show modal if no pending items
        }
        
        $('#modalModuleName').text(module);
        $('#pendingItemsLoader').show();
        $('#pendingItemsContent').hide();
        $('#pendingItemsError').hide();
        $('#pendingModal').modal('show');
        
        // Load pending items via AJAX
        $.ajax({
            url: '<?php echo site_url("welcome/get_pending_items"); ?>',
            type: 'POST',
            data: { module: module },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var tableBody = '';
                    var itemCount = 0;
                    
                    if (response.data && response.data.length > 0) {
                        itemCount = response.data.length;
                        
                        $.each(response.data, function(index, item) {
                            tableBody += '<tr>';
                            tableBody += '<td>' + item.project_id + '</td>';
                            tableBody += '<td>' + (item.sample_id || '-') + '</td>';
                            // tableBody += '<td>' + (item.client || 'Unknown Client') + '</td>';
                            tableBody += '<td>' + item.date_created + '</td>';
                            
                            /* 
                            // ACTION COLUMN - Hidden for now, may be needed in the future
                            tableBody += '<td class="text-center">';
                            // Map module to valid controller URL
                            var moduleUrls = {
                                'Biobank Storage': 'biobankin',
                                'Moisture Content': 'moisture_content', 
                                'Campylobacter (Biosolids)': 'campy_biosolids',
                                'Campylobacter (Liquids)': 'campy_liquids',
                                'Campylobacter P/A': 'campy_pa',
                                'Salmonella (Liquids)': 'salmonella_liquids',
                                'Salmonella (Biosolids)': 'salmonella_biosolids',
                                'Salmonella P/A': 'salmonella_pa',
                                'DNA Extraction (Culture)': 'extraction_culture',
                                'DNA Extraction (Liquid)': 'extraction_liquid',
                                'DNA Extraction (Metagenome)': 'extraction_metagenome',
                                'DNA Extraction (Biosolid)': 'extraction_biosolid',
                                'Enterolert (Water)': 'enterolert_idexx_water',
                                'Enterolert (Biosolids)': 'enterolert_idexx_biosolids',
                                'Colilert (Biosolids)': 'colilert_idexx_biosolids',
                                'Colilert (Water)': 'colilert_idexx_water',
                                'Protozoa Analysis': 'protozoa',
                                'HemoFlow Analysis': 'hemoflow'
                            };
                            
                            var moduleController = moduleUrls[item.module_name] || 'sample_reception';
                            var viewUrl = '<?php echo base_url(); ?>index.php/' + moduleController;
                            
                            if (item.sample_id && item.sample_id !== '-' && item.sample_id !== 'Unknown Project') {
                                // Add sample_id as filter parameter for the specific module
                                viewUrl += '?sample_id=' + encodeURIComponent(item.sample_id);
                            }
                            
                            tableBody += '<a href="' + viewUrl + '" class="btn btn-xs btn-success" target="_blank" title="Go to ' + item.module_name + ' module for this sample">';
                            tableBody += '<i class="fa fa-flask"></i> Open in Module';
                            tableBody += '</a>';
                            tableBody += '</td>';
                            */
                            tableBody += '</tr>';
                        });
                    } else {
                        tableBody = '<tr><td colspan="4" class="text-center">No pending items found</td></tr>';
                    }
                    
                    // Update item count
                    $('#pendingItemsCount').html('<strong>' + itemCount + '</strong>');
                    
                    $('#pendingItemsTableBody').html(tableBody);
                    $('#pendingItemsLoader').hide();
                    $('#pendingItemsContent').show();
                    

                    
                    // Update timestamp
                    var now = new Date();
                    $('#lastUpdatedTime').text(now.toLocaleTimeString());
                } else {
                    $('#pendingItemsLoader').hide();
                    $('#pendingItemsError').show();
                }
            },
            error: function() {
                $('#pendingItemsLoader').hide();
                $('#pendingItemsError').show();
            }
        });
    });

    // Add real-time clock
    function updateClock() {
        var now = new Date();
        var timeString = now.toLocaleTimeString();
        $('#current-time').text(timeString);
    }
    
    // Add clock to header if needed
    if ($('#current-time').length === 0) {
        $('.box-tools').append('<span id="current-time" class="label label-default" style="margin-left: 10px;"></span>');
    }
    
    setInterval(updateClock, 1000);
    updateClock();
});
</script>

<style>
/* Modern Tables & Elements - Dashboard Scoped */
.dashboard-container .table {
  background: var(--ui-surface) !important;
  border-radius: var(--ui-radius) !important;
  overflow: hidden !important;
}

.dashboard-container .table > thead > tr > th {
  background: var(--ui-surface-alt) !important;
  color: var(--ui-text) !important;
  border-bottom: 2px solid var(--ui-border) !important;
  font-weight: 600 !important;
  padding: 16px !important;
}

.dashboard-container .table > tbody > tr > td {
  border-top: 1px solid var(--ui-border) !important;
  color: var(--ui-text) !important;
  padding: 14px 16px !important;
}

.dashboard-container .table > tbody > tr:hover {
  background: var(--ui-surface-alt) !important;
}

/* Modern Badges */
.badge {
  border-radius: 8px !important;
  font-weight: 500 !important;
  padding: 6px 12px !important;
  font-size: 12px !important;
}

.badge.bg-blue {
  background: var(--ui-accent) !important;
  color: white !important;
}

.badge.bg-green {
  background: var(--ui-success) !important;
  color: white !important;
}

.badge.bg-yellow {
  background: var(--ui-warning) !important;
  color: white !important;
}

.badge.bg-aqua {
  background: var(--ui-accent) !important;
  color: white !important;
}

.badge.bg-gray {
  background: var(--ui-text-secondary) !important;
  color: white !important;
}

/* Modern Labels */
.label {
  border-radius: 6px !important;
  font-weight: 500 !important;
  padding: 4px 10px !important;
}

.label-success {
  background: var(--ui-success) !important;
}

.label-warning {
  background: var(--ui-warning) !important;
  color: var(--ui-text) !important;
}

.label-danger {
  background: var(--ui-danger) !important;
}

.label-primary {
  background: var(--ui-accent) !important;
}

.label-default {
  background: var(--ui-text-secondary) !important;
}

/* Modern Progress Bars */
.progress {
  background: var(--ui-surface-alt) !important;
  border-radius: 6px !important;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.05) !important;
}

.progress-bar-success {
  background: linear-gradient(90deg, var(--ui-success), #52C49A) !important;
}

.progress-bar-warning {
  background: linear-gradient(90deg, var(--ui-warning), #F7D063) !important;
}

.progress-bar-danger {
  background: linear-gradient(90deg, var(--ui-danger), #E86F6F) !important;
}

/* Modern Timeline */
.timeline > li > .timeline-item {
    background: var(--ui-surface) !important;
    border: 1px solid var(--ui-border) !important;
    border-radius: var(--ui-radius) !important;
    box-shadow: var(--ui-shadow-sm) !important;
    margin-right: 15px;
    margin-left: 15px;
    margin-top: 0;
    padding: 0;
    transition: all 0.3s ease !important;
}

.timeline > li > .timeline-item:hover {
    box-shadow: var(--ui-shadow-md) !important;
}

.timeline > li > .timeline-item > .timeline-header {
    border-bottom: 1px solid var(--ui-border) !important;
    color: var(--ui-text) !important;
    background: var(--ui-surface-alt) !important;
    font-size: 16px;
    font-weight: 600;
    line-height: 1.1;
    margin: 0;
    padding: 12px 16px;
    border-radius: var(--ui-radius) var(--ui-radius) 0 0 !important;
}

.timeline > li > .timeline-item > .timeline-body,
.timeline > li > .timeline-item > .timeline-footer {
    padding: 12px 16px;
    color: var(--ui-text-secondary) !important;
}

/* Modern Buttons - Dashboard Scoped */
.dashboard-container .btn {
  border-radius: 8px !important;
  font-weight: 500 !important;
  transition: all 0.3s ease !important;
  border: none !important;
  padding: 10px 20px !important;
}

.dashboard-container .btn-primary {
  background: linear-gradient(135deg, var(--ui-accent) 0%, #6B7EF7 100%) !important;
  color: white !important;
}

.dashboard-container .btn-primary:hover {
  background: linear-gradient(135deg, #3D5BF2 0%, var(--ui-accent) 100%) !important;
  transform: translateY(-1px) !important;
  box-shadow: 0 4px 12px rgba(77, 110, 245, 0.3) !important;
}

.dashboard-container .btn-success {
  background: linear-gradient(135deg, var(--ui-success) 0%, #52C49A 100%) !important;
  color: white !important;
}

.dashboard-container .btn-success:hover {
  background: linear-gradient(135deg, #2FA876 0%, var(--ui-success) 100%) !important;
  transform: translateY(-1px) !important;
}

.dashboard-container .btn-warning {
  background: linear-gradient(135deg, var(--ui-warning) 0%, #F7D063 100%) !important;
  color: var(--ui-text) !important;
}

.dashboard-container .btn-warning:hover {
  background: linear-gradient(135deg, #F2B53F 0%, var(--ui-warning) 100%) !important;
  transform: translateY(-1px) !important;
}

.dashboard-container .btn-app {
  background: var(--ui-surface) !important;
  border: 2px solid var(--ui-border) !important;
  color: var(--ui-text) !important;
  border-radius: var(--ui-radius) !important;
  transition: all 0.3s ease !important;
}

.dashboard-container .btn-app:hover {
  background: var(--ui-accent-soft) !important;
  border-color: var(--ui-accent) !important;
  color: var(--ui-accent) !important;
  transform: translateY(-2px) !important;
}

/* DataTables Modern Styling - Dashboard Scoped */
.dashboard-container .dataTables_wrapper {
  background: var(--ui-surface) !important;
  border-radius: var(--ui-radius) !important;
  padding: 20px !important;
  box-shadow: var(--ui-shadow-sm) !important;
}

.dashboard-container .dataTables_filter input {
  background: var(--ui-surface) !important;
  border: 2px solid var(--ui-border) !important;
  border-radius: 8px !important;
  color: var(--ui-text) !important;
  padding: 8px 12px !important;
  transition: all 0.3s ease !important;
}

.dashboard-container .dataTables_filter input:focus {
  border-color: var(--ui-accent) !important;
  box-shadow: 0 0 0 3px var(--ui-accent-soft) !important;
  outline: none !important;
}

.dashboard-container .dataTables_length select {
  background: var(--ui-surface) !important;
  border: 2px solid var(--ui-border) !important;
  border-radius: 6px !important;
  color: var(--ui-text) !important;
  padding: 6px 10px !important;
}

/* Pagination Modern Styling - Dashboard Scoped */
.dashboard-container .dataTables_paginate .paginate_button {
  background: var(--ui-surface) !important;
  border: 1px solid var(--ui-border) !important;
  color: var(--ui-text) !important;
  border-radius: 6px !important;
  margin: 0 2px !important;
  transition: all 0.3s ease !important;
}

.dashboard-container .dataTables_paginate .paginate_button:hover {
  background: var(--ui-accent-soft) !important;
  border-color: var(--ui-accent) !important;
  color: var(--ui-accent) !important;
}

.dashboard-container .dataTables_paginate .paginate_button.current {
  background: var(--ui-accent) !important;
  border-color: var(--ui-accent) !important;
  color: white !important;
}

/* =====================================
   🎨 MODERN CHART UI 2025 STYLING
===================================== */

/* Chart Container - Clean & Soft Design */
.dashboard-container .box.chart-container {
  background: linear-gradient(135deg, #FFFFFF 0%, #FAFBFC 100%) !important;
  border: none !important;
  border-radius: 20px !important;
  box-shadow: 
    0 4px 20px rgba(77, 110, 245, 0.08),
    0 1px 3px rgba(0, 0, 0, 0.02) !important;
  backdrop-filter: blur(10px) !important;
  transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
}

.dashboard-container .box.chart-container:hover {
  transform: translateY(-2px) !important;
  box-shadow: 
    0 8px 30px rgba(77, 110, 245, 0.12),
    0 2px 6px rgba(0, 0, 0, 0.04) !important;
}

.dashboard-container .box.chart-container .box-header {
  background: transparent !important;
  border-bottom: 1px solid rgba(241, 243, 245, 0.8) !important;
  border-radius: 20px 20px 0 0 !important;
  padding: 25px 30px 20px !important;
}

.dashboard-container .box.chart-container .box-body {
  background: transparent !important;
  padding: 20px 30px 30px !important;
  border-radius: 0 0 20px 20px !important;
}

/* Modern Chart Container */
#monthly_chart {
  background: transparent !important;
  border-radius: 16px !important;
  padding: 0 !important;
  min-height: 320px !important;
}

/* Year Selector - Glassmorphism Style */
#year_selector {
  background: rgba(255, 255, 255, 0.9) !important;
  backdrop-filter: blur(10px) !important;
  border: 1px solid rgba(226, 228, 232, 0.6) !important;
  border-radius: 12px !important;
  color: var(--ui-text) !important;
  font-size: 13px !important;
  font-weight: 500 !important;
  height: 34px !important;
  min-width: 85px !important;
  padding: 6px 12px !important;
  transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
  box-shadow: 0 2px 8px rgba(77, 110, 245, 0.08) !important;
}

#year_selector:hover {
  background: rgba(255, 255, 255, 1) !important;
  border-color: rgba(77, 110, 245, 0.3) !important;
  box-shadow: 0 4px 16px rgba(77, 110, 245, 0.15) !important;
}

#year_selector:focus {
  background: rgba(255, 255, 255, 1) !important;
  border-color: var(--ui-accent) !important;
  box-shadow: 
    0 0 0 3px rgba(77, 110, 245, 0.1),
    0 4px 20px rgba(77, 110, 245, 0.2) !important;
  outline: none !important;
}

/* Year Selector Label */
.year-selector-label {
  font-size: 13px !important;
  font-weight: 500 !important;
  color: #6B7178 !important;
  margin-right: 8px !important;
  letter-spacing: -0.2px !important;
}

/* Chart Loading Indicator - Modern Animation */
#chart_loading {
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(250, 251, 252, 0.95) 100%) !important;
  backdrop-filter: blur(20px) !important;
  color: var(--ui-text-secondary) !important;
  border-radius: 16px !important;
  border: 1px solid rgba(226, 228, 232, 0.3) !important;
  padding: 60px 40px !important;
  margin: 20px !important;
}

#chart_loading .fa-spinner {
  color: var(--ui-accent) !important;
  filter: drop-shadow(0 2px 8px rgba(77, 110, 245, 0.3)) !important;
}

#chart_loading p {
  font-size: 14px !important;
  font-weight: 500 !important;
  letter-spacing: -0.2px !important;
  margin-top: 16px !important;
}

/* Floating Animation for Chart Container */
@keyframes float-chart {
  0%, 100% { 
    transform: translateY(0px) rotate(0deg); 
  }
  50% { 
    transform: translateY(-3px) rotate(0.5deg); 
  }
}

.dashboard-container .box.chart-container:hover {
  animation: float-chart 6s ease-in-out infinite !important;
}

/* Modern Alert Styles for Chart Errors */
#monthly_chart .alert {
  background: linear-gradient(135deg, rgba(245, 192, 77, 0.1) 0%, rgba(243, 156, 18, 0.05) 100%) !important;
  border: 1px solid rgba(245, 192, 77, 0.2) !important;
  border-radius: 12px !important;
  color: #B8860B !important;
  font-weight: 500 !important;
  padding: 20px !important;
  margin: 20px !important;
}

#monthly_chart .alert-danger {
  background: linear-gradient(135deg, rgba(224, 91, 91, 0.1) 0%, rgba(220, 53, 69, 0.05) 100%) !important;
  border-color: rgba(224, 91, 91, 0.2) !important;
  color: #C53030 !important;
}

/* Responsive Design for Chart */
@media (max-width: 768px) {
  .dashboard-container .box.chart-container {
    margin: 10px !important;
    border-radius: 16px !important;
  }
  
  .dashboard-container .box.chart-container .box-header,
  .dashboard-container .box.chart-container .box-body {
    padding: 20px !important;
  }
  
  #monthly_chart {
    min-height: 280px !important;
  }
  
  #year_selector {
    font-size: 12px !important;
    height: 30px !important;
    min-width: 75px !important;
  }
}

.progress-xs {
    height: 7px;
}

.badge {
    font-size: 11px;
    font-weight: 600;
}

.box-title {
    font-size: 18px;
    font-weight: 600;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .small-box .icon > i {
        font-size: 60px;
    }
    
    .small-box:hover .icon > i {
        font-size: 65px;
    }
    
    .timeline {
        margin-left: 0;
    }
    
    .timeline > li > .timeline-item {
        margin-left: 0;
        margin-right: 0;
    }
    
    /* DataTables responsive adjustments */
    .dataTables_length,
    .dataTables_filter {
        margin-top: 0;
        margin-bottom: 0;
    }
}

/* DataTables Layout Improvements */
.dataTables_wrapper .dataTables_length {
    float: left;
    margin-bottom: 10px;
}

.dataTables_wrapper .dataTables_filter {
    float: right;
    text-align: right;
    margin-bottom: 10px;
}

.dataTables_wrapper .dataTables_length select {
    display: inline-block;
    width: auto;
    margin: 0 5px;
}

.dataTables_wrapper .dataTables_filter input {
    display: inline-block;
    width: auto;
    margin-left: 5px;
    padding: 6px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
    margin-top: 0;
    margin-bottom: 15px;
}

.dataTables_wrapper .dataTables_info {
    float: left;
    padding-top: 8px;
}

.dataTables_wrapper .dataTables_paginate {
    float: right;
    text-align: right;
    padding-top: 0;
}

/* Clear float for proper alignment */
.dataTables_wrapper:after {
    content: "";
    display: table;
    clear: both;
}

/* Ensure proper spacing */
#workflow-table_wrapper .row:first-child {
    margin-bottom: 15px;
}

#workflow-table_wrapper .row:last-child {
    margin-top: 15px;
}

/* Responsive DataTables */
@media (max-width: 768px) {
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        float: none;
        text-align: left;
        margin-bottom: 10px;
    }
    
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        float: none;
        text-align: center;
        margin-top: 10px;
    }
    
    /* Modern Table Mobile Responsive */
    #pendingModal .modal-dialog {
        margin: 10px;
    }
    
    .modern-table-container {
        max-height: 00px;
    }
    
    #pendingModal .modal-body {
        max-height: 60vh;
    }
    
    .modern-th,
    .modern-tbody td {
        padding: 12px 15px;
        font-size: 12px;
    }
    
    .modern-info-bar {
        padding: 15px 20px;
    }
    
    .info-badge {
        padding: 6px 12px;
        font-size: 13px;
    }
    
    .modern-loader {
        padding: 40px 20px;
    }
}

/* Modern Modal Styling */
.modal-content {
  background: var(--ui-surface) !important;
  border: none !important;
  border-radius: var(--ui-radius) !important;
  box-shadow: 0 20px 60px rgba(0,0,0,0.15) !important;
}

.modal-header {
  background: linear-gradient(135deg, var(--ui-accent) 0%, #6B7EF7 100%) !important;
  border: none !important;
  border-radius: var(--ui-radius) var(--ui-radius) 0 0 !important;
  color: white !important;
}

.modal-title {
  color: white !important;
  font-weight: 600 !important;
}

.modal-body {
  background: var(--ui-surface) !important;
  color: var(--ui-text) !important;
}

.modal-footer {
  background: var(--ui-surface-alt) !important;
  border-top: 1px solid var(--ui-border) !important;
  border-radius: 0 0 var(--ui-radius) var(--ui-radius) !important;
}

/* Alert Styling */
.alert {
  border-radius: var(--ui-radius) !important;
  border: none !important;
}

.alert-danger {
  background: rgba(224, 91, 91, 0.1) !important;
  color: var(--ui-danger) !important;
  border-left: 4px solid var(--ui-danger) !important;
}

/* Modern Pending Badge */
.pending-badge {
    transition: all 0.3s ease;
    position: relative;
    background: var(--ui-warning) !important;
    color: white !important;
    border-radius: 8px !important;
    cursor: pointer;
}

.pending-badge:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(245, 192, 77, 0.4) !important;
    background: #F2B53F !important;
}

.pending-badge:before {
    content: "Click to view details";
    position: absolute;
    bottom: -25px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 10px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
    z-index: 1000;
}

.pending-badge:hover:before {
    opacity: 1;
}

/* Modern Table Design */
.modern-table-container {
    background: var(--ui-surface) !important;
    border: 1px solid var(--ui-border) !important;
    border-radius: var(--ui-radius) !important;
    box-shadow: var(--ui-shadow-sm) !important;
    overflow: hidden;
}

.modern-table-container::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

.modern-table-container::-webkit-scrollbar-track {
    background: var(--ui-surface-alt) !important;
}

.modern-table-container::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, var(--ui-accent), #6B7EF7) !important;
    border-radius: 6px;
}

.modern-table-container::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #3D5BF2, var(--ui-accent)) !important;
}

.modern-table {
    width: 100%;
    margin: 0;
    border-collapse: collapse;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.modern-thead {
    background: linear-gradient(135deg, var(--ui-warning) 0%, #F7D063 100%) !important;
    position: sticky;
    top: 0;
    z-index: 10;
    box-shadow: 0 2px 4px rgba(245, 192, 77, 0.1) !important;
}

.modern-th {
    color: #ffffff !important;
    font-weight: 600;
    font-size: 14px;
    text-align: left;
    padding: 16px 20px;
    border: none;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    font-size: 12px;
    position: relative;
}

.modern-th::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: rgba(255, 255, 255, 0.3);
}

.modern-tbody tr {
    border-bottom: 1px solid #e2e8f0;
    transition: all 0.2s ease;
}

.modern-tbody tr:hover {
    background-color: var(--ui-surface-alt) !important;
    transform: translateY(-1px);
    box-shadow: var(--ui-shadow-sm) !important;
}

.modern-tbody tr:last-child {
    border-bottom: none;
}

.modern-tbody td {
    padding: 16px 20px;
    color: var(--ui-text) !important;
    font-size: 14px;
    line-height: 1.5;
    border: none;
    vertical-align: middle;
}

.modern-tbody td:first-child {
    font-weight: 600;
    color: var(--ui-text) !important;
}

.modern-tbody tr:nth-child(even) {
    background-color: var(--ui-surface) !important;
}

.modern-tbody tr:nth-child(odd) {
    background-color: var(--ui-surface-alt) !important;
}

/* Modern Info Bar */
.modern-info-bar {
    padding: 20px 25px;
    background: linear-gradient(90deg, var(--ui-surface-alt) 0%, var(--ui-surface) 100%) !important;
    border-bottom: 1px solid var(--ui-border) !important;
}

.info-content {
    display: flex;
    align-items: center;
    gap: 12px;
}

.info-badge {
    background: linear-gradient(135deg, var(--ui-warning) 0%, #F7D063 100%) !important;
    color: var(--ui-text) !important;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 14px;
    box-shadow: 0 2px 8px rgba(245, 192, 77, 0.3) !important;
}

.info-text {
    color: var(--ui-text-secondary) !important;
    font-size: 14px;
    font-weight: 500;
}

#pendingModal .modal-header {
    background: linear-gradient(135deg, var(--ui-warning) 0%, #F7D063 100%) !important;
    border: none;
    padding: 20px 25px;
    border-radius: var(--ui-radius) var(--ui-radius) 0 0 !important;
    box-shadow: 0 2px 8px rgba(245, 192, 77, 0.2) !important;
}

#pendingModal .modal-header .modal-title {
    color: #ffffff !important;
    font-weight: 600;
    font-size: 18px;
    text-shadow: 0 1px 2px rgba(0,0,0,0.1) !important;
}

#pendingModal .modal-header .close {
    color: #ffffff !important;
    opacity: 0.9;
    text-shadow: none;
    font-size: 24px;
    transition: all 0.3s ease !important;
    border-radius: 50% !important;
    width: 32px !important;
    height: 32px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

#pendingModal .modal-header .close:hover {
    opacity: 1;
    color: #ffffff !important;
    background: rgba(255,255,255,0.1) !important;
    transform: scale(1.1) !important;
}

#pendingModal .modal-footer {
    background: var(--ui-surface-alt) !important;
    border-top: 1px solid var(--ui-border) !important;
    border-radius: 0 0 var(--ui-radius) var(--ui-radius) !important;
    padding: 15px 25px;
}

/* Modern Pending Modal Buttons */
#pendingModal .btn-warning {
    background: linear-gradient(135deg, var(--ui-warning) 0%, #F7D063 100%) !important;
    color: var(--ui-text) !important;
    border: none !important;
    border-radius: 8px !important;
    font-weight: 500 !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 2px 4px rgba(245, 192, 77, 0.2) !important;
}

#pendingModal .btn-warning:hover {
    background: linear-gradient(135deg, #F2B53F 0%, var(--ui-warning) 100%) !important;
    color: var(--ui-text) !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(245, 192, 77, 0.3) !important;
}

/* Modern Table Row Hover in Modal */
#pendingModal .modern-tbody tr:hover {
    background-color: rgba(245, 192, 77, 0.05) !important;
    border-left: 3px solid var(--ui-warning) !important;
}

/* Modern Scrollbar for Modal Table */
#pendingModal .modern-table-container::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, var(--ui-warning), #F7D063) !important;
}

#pendingModal .modern-table-container::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #F2B53F, var(--ui-warning)) !important;
}

#pendingModal .modal-content {
    border: none;
    border-radius: var(--ui-radius) !important;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15) !important;
    overflow: hidden !important;
}

#pendingModal .modal-body {
    background: var(--ui-surface) !important;
    padding: 0 !important;
}

/* Modern Modal Enhancements */
#pendingModal .modal-dialog {
    margin: 30px auto !important;
    transition: all 0.3s ease !important;
}

#pendingModal.fade .modal-dialog {
    transform: translate(0, -50px) !important;
}

#pendingModal.in .modal-dialog {
    transform: translate(0, 0) !important;
}

/* Modern Loading Animation */
.modern-loader {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 60px 40px;
    background: linear-gradient(135deg, var(--ui-surface-alt) 0%, var(--ui-surface) 100%) !important;
}

.loader-animation {
    display: flex;
    gap: 8px;
    margin-bottom: 20px;
}

.pulse-loader {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--ui-warning) 0%, #F7D063 100%) !important;
    animation: pulseScale 1.5s ease-in-out infinite;
}

.pulse-delay-1 {
    animation-delay: 0.2s;
}

.pulse-delay-2 {
    animation-delay: 0.4s;
}

@keyframes pulseScale {
    0%, 80%, 100% {
        transform: scale(0.8);
        opacity: 0.5;
    }
    40% {
        transform: scale(1.2);
        opacity: 1;
    }
}

.loader-text {
    color: var(--ui-text-secondary) !important;
    font-size: 16px;
    font-weight: 500;
    margin: 0;
    letter-spacing: 0.5px;
}

/* Modern Typography - Dashboard Scoped */
.dashboard-container h1, 
.dashboard-container h2, 
.dashboard-container h3, 
.dashboard-container h4, 
.dashboard-container h5, 
.dashboard-container h6 {
    color: var(--ui-text) !important;
}

.dashboard-container p {
    color: var(--ui-text-secondary) !important;
}

/* Modern Form Controls - Dashboard Scoped */
.dashboard-container .form-control {
    background: var(--ui-surface) !important;
    border: 2px solid var(--ui-border) !important;
    border-radius: 8px !important;
    color: var(--ui-text) !important;
    transition: all 0.3s ease !important;
}

.dashboard-container .form-control:focus {
    border-color: var(--ui-accent) !important;
    box-shadow: 0 0 0 3px var(--ui-accent-soft) !important;
    background: var(--ui-surface) !important;
}

/* Modern Navigation */
.nav-tabs > li > a {
    background: var(--ui-surface) !important;
    color: var(--ui-text-secondary) !important;
    border: 2px solid var(--ui-border) !important;
    border-radius: 8px 8px 0 0 !important;
}

.nav-tabs > li.active > a {
    background: var(--ui-accent) !important;
    color: white !important;
    border-color: var(--ui-accent) !important;
}

/* Modern Box Variants */
.box-primary {
    border-top-color: var(--ui-accent) !important;
}

.box-success {
    border-top-color: var(--ui-success) !important;
}

.box-warning {
    border-top-color: var(--ui-warning) !important;
}

.box-danger {
    border-top-color: var(--ui-danger) !important;
}

.box-info {
    border-top-color: var(--ui-accent) !important;
}

/* Responsive Table Adjustments */
@media (max-width: 768px) {
    #pendingModal .modal-dialog {
        margin: 10px;
    }
    
    #pendingModal .table-container {
        max-height: 300px;
    }
    
    #pendingModal .modal-body {
        max-height: 60vh;
    }
    
    #pendingModal #pendingItemsTable th,
    #pendingModal #pendingItemsTable td {
        padding: 6px 8px;
        font-size: 12px;
    }
}
</style>
<script src="<?php echo base_url('assets/js/export-data.js') ?>"></script>
<script src="<?php echo base_url('assets/js/accessibility.js') ?>"></script>

<!-- <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script> -->
        <script type="text/javascript">
            let t
            $(document).ready(function() {

            Highcharts.chart('chart_container', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie',
                    height: "350px"
                },
                
                title: {
                    text: 'Total samples per-objectives',
                    align: 'left'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                    valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    },
                    showInLegend: true,
                    point: {
                            events: {
                                legendItemClick: function (e) {
                                    console.log(e.target.name)
                                }
                            }
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    itemMarginTop: 10,
                    itemMarginBottom: 10,
                    itemMarginRight: 100,

                    },
                series: [{
                    name: 'Samples',
                    colorByPoint: true,
                    data: 
                    [<?php foreach ($item as $rows) {
                        echo ' {
                            name: "'.$rows->item.'",
                            y: '.$rows->val.'
                          },';
                    } ?>]
                }]
                });

            Highcharts.chart('sub_container', {
                        chart: {
                            type: 'column',
                            height: '300px'
                        },
                        title: {
                            text: 'Total samples per-type all objectives',
                            align: 'left'

                        },
                        
                        xAxis: {
                            categories: 
                            // ['sub1', 'sub2', 'sub3'],
                            [
                                <?php foreach ($obj as $row) {
                                    echo "'$row->type'" . ',';      
                                } ?>
                            ],
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Sample type from all Objectives'
                            }
                        },
                        legend:{ enabled:false },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{point.key}: </td>' +
                                '<td style="padding:0"><b>{point.y}</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0,
                                colorByPoint: true,
                                dataLabels: {
                                    enabled: true,
                                    crop: false,
                                    overflow: 'none'
                                }
                            },
                            colors: [
                                '#ff0000',
                                '#00ff00',
                                '#0000ff'
                            ]
                        },
                        series: [
                            {
                                data : 
                                // [{name: 'sub1', y: 100},{name: 'sub2', y: 70},{name: 'sub3', y: 30},]

                                [
                                    <?php foreach ($obj as $row) {
                                        echo "{name: '$row->type',y: $row->val},";
                                    }?>
                                ]
                            }]
                    });                
            });

        // Real-time clock update
        function updateTime() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const timeString = hours + ':' + minutes;
            
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                timeElement.textContent = timeString;
            }
        }

        // Update time immediately and then every minute
        updateTime();
        setInterval(updateTime, 60000); // Update every minute
</script>