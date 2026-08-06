# Bhaiyyantop - Custom WordPress News Theme

A premium, production-ready, custom-designed WordPress news theme built to match the high-fidelity design of the Hindi news website **भैय्यान्टॉप**.

This theme features custom typography (Outfit and Noto Sans Devanagari for readability), an auto-scrolling breaking news ticker, an interactive featured post slider, tab-based category filters, and a responsive 3-column dashboard layout.

---

## 🚀 Features

- **3-Column Dashboard**: Structured layout featuring featured news on the left, primary sliders/carousels in the center, and Editor's Choice on the right.
- **Breaking News Ticker**: Highly interactive and auto-scrolling ticker bar for highlights.
- **Dynamic Category Tabs**: Instantly filter recent news cards by tags/categories.
- **Mobile First & Responsive**: Optimized for layout stability and swift rendering across mobile, tablet, and desktop screens.
- **Mock Data Fallbacks**: Renders mock content matching the screenshot out-of-the-box on a fresh WordPress install, transitioning automatically when database posts are published.
- **Font & Icon Integrations**: Pre-integrated Google Fonts (Outfit, Noto Sans Devanagari) and FontAwesome icons.

---

## 📂 Repository Structure

- `bhaiyyantop/` - Contains the full source code for the WordPress theme.
  - `style.css` - Theme header and primary responsive design styling.
  - `functions.php` - Scripts enqueuing, layout support setup, navigation, and sidebar widget declarations.
  - `header.php` - Global site header containing branding logo markup, navigation controls, and breaking news ticker.
  - `footer.php` - Global footer displaying widget content, credentials, and social links.
  - `front-page.php` - Homepage layout including the 3 columns and bottom section.
  - `single.php` & `archive.php` - Standard page templates for articles and category lists.
  - `sidebar.php` - Dynamic widget support fallback.
  - `assets/` - Theme images and interactive `theme.js` controllers.
- `bhaiyyantop.zip` - Pre-packaged, installable theme archive ready for production.
- `index.php` - Mock WordPress environment router for fast local layout previewing.

---

## 🛠️ Installation & Setup

### Option 1: WordPress Upload (Recommended)
1. Download the pre-built theme ZIP file: [bhaiyyantop.zip](./bhaiyyantop.zip).
2. Open your WordPress Admin Dashboard and navigate to **Appearance** $\rightarrow$ **Themes** $\rightarrow$ **Add New** $\rightarrow$ **Upload Theme**.
3. Choose the `bhaiyyantop.zip` file, click **Install Now**, and click **Activate**.

### Option 2: Local Developer Preview (Without WordPress)
To view the theme's frontend design, layout flow, and interactions without running a full WordPress database setup:
1. Make sure you have PHP installed:
   ```bash
   sudo apt update && sudo apt install php-cli
   ```
2. Start the built-in PHP runner in this directory:
   ```bash
   php -S localhost:8000
   ```
3. Open your web browser and go to: **[http://localhost:8000](http://localhost:8000)**.
