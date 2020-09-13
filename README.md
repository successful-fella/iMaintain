## Challenge Statement -
Develop a solution such field engineers can scan QR Code using your app, do servicing and note the details in app. This is two entity system where supervisor can see real time scanning data and engineers instead of old fashioned putting maintenance labels and dates, use app on their smartphone to carry out the same.

## What is iMaintain?
Built on PHP, iMaintain is PWA for mobile app (/engineer route) and dashboard for supervisor (/supervisor route). Since engineer is a PWA, interface is mobile first. Engineer can see history, scan QR code to know equipment details and add servicing history. It have advance backend logic to transfer servicing history to one another. Camera media API is used for QR code proccessing which is read and sent to server.

# How to setup?
A whole lot is generalised so all you've to do is to clone this repository, import the imaintain.sql file and setup database connection at `iMaintain/config/database.php`. Database comes with pre populated data.
Login for engineer is - 2:2590 (/engineer)
Login for supervisor is - 2590:2590 (/supervisor)

# What's more?
* Interface is built with the help of https://github.com/shivammagarde. He is absolutely amazing in UI/UX desiging, prototyping (Adobe XD) and creating videos in Premiere Pro.
* I set up PWA, JavaScript and all PHP part.
* We completed iMaintain in 2-3 days.
* There is a Django version available at https://github.com/yashwardhanchauhan/iMaintain. It was built on the basis of this PHP version.
* You can use Init controller to add a landing page.

> This project was made almost a year back, many coding standards and all are changed so this needs rework.
