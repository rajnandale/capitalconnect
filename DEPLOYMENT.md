# GitHub Pages Deployment Guide

This document explains how the GitHub Pages deployment works for the CapitalConnect project.

## Automatic Deployment

The project is configured to automatically deploy to GitHub Pages using GitHub Actions. The workflow file is located at `.github/workflows/static.yml`.

### How it works

1. **Trigger**: The deployment workflow triggers automatically on every push to the `master` branch
2. **Build**: The workflow uploads the entire repository as a static site artifact
3. **Deploy**: The artifact is deployed to GitHub Pages
4. **URL**: The site will be available at `https://rajnandale.github.io/capitalconnect/`

## Enabling GitHub Pages (One-time Setup)

After merging this PR, the repository owner needs to enable GitHub Pages:

1. Go to your repository on GitHub
2. Click on **Settings**
3. Navigate to **Pages** in the left sidebar
4. Under **Source**, select **GitHub Actions**
5. Save the changes

The site will be live within a few minutes after the next push to the master branch.

## What Gets Deployed

The GitHub Pages deployment includes:

- **index.html** - The main landing page (static showcase)
- **about.html** - About page
- **feedback.html** - Feedback/Contact page  
- **privacy.html** - Privacy policy page
- **screenshots/** - All application screenshots
- **Images** - Logo and other image assets

## Important Limitations

⚠️ **GitHub Pages only supports static HTML/CSS/JavaScript files**

This means:
- PHP files will NOT be executed
- MySQL database connections will NOT work
- Dynamic features requiring server-side processing will NOT function

The deployed version is a **static showcase** that:
- ✅ Displays project information and features
- ✅ Shows screenshots and documentation
- ✅ Provides setup instructions for local installation
- ✅ Links to the GitHub repository
- ❌ Does NOT provide the full application functionality

## For Full Functionality

To run the complete application with all features:

1. Follow the local setup instructions on the landing page
2. Install XAMPP with Apache and MySQL
3. Set up the database using the provided SQL files
4. Access the application at `localhost/capitalconnect`

## Manual Deployment

If you need to manually trigger a deployment:

1. Go to the **Actions** tab in your repository
2. Select the **Deploy static content to Pages** workflow
3. Click **Run workflow**
4. Select the `master` branch
5. Click **Run workflow**

## Updating the Site

To update the GitHub Pages site:

1. Make changes to `index.html` or other static files
2. Commit and push to the `master` branch
3. The workflow will automatically redeploy the site
4. Changes will be live within 1-2 minutes

## Troubleshooting

### Site not loading
- Check that GitHub Pages is enabled in repository settings
- Verify the workflow completed successfully in the Actions tab
- Wait a few minutes for DNS propagation

### Images not showing
- Ensure image paths are relative (e.g., `screenshots/home.png`)
- Check that the `.nojekyll` file exists in the root directory
- Verify images are committed to the repository

### Workflow failing
- Check the Actions tab for error messages
- Ensure the workflow file has correct permissions
- Verify the repository has Pages deployment enabled

## Additional Resources

- [GitHub Pages Documentation](https://docs.github.com/en/pages)
- [GitHub Actions Documentation](https://docs.github.com/en/actions)
- [CapitalConnect Repository](https://github.com/rajnandale/capitalconnect)
