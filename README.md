# e-Jood — Donation Matching Platform

A full-stack web platform that connects donors, volunteers, and charitable
organizations to route donated goods to the families who need them.

> Student project, built 2022–2023.

## What it does

A complete donation workflow in one web application:

- **Donors** — register and list the items they want to give.
- **Volunteers** — sign up, receive tasks, and mark them complete.
- **Organizations** — receive and manage incoming donations.
- **Item tracking** — follow each donated item from offer to delivery.
- **Dashboards** — live, at-a-glance views of donors, volunteers, organizations, and items.

## Tech stack

| Layer         | Technology                                            |
|---------------|-------------------------------------------------------|
| Backend       | PHP (procedural) + MySQL                              |
| Frontend      | HTML, CSS, JavaScript, Bootstrap (Bootslander template) |
| Notifications | SMS gateway integration for task updates             |

## The idea behind it

What makes e-Jood more than another CRUD app is the idea at its center: using AI to
automatically classify donated items by type and condition, so charities spend far
less time sorting by hand. The payoff is simple but meaningful — a faster pipeline
from "donation received" to "family helped."

A prototype of the classification was explored using Python and PictoBlox.

## Project structure

```
*.php        Server-side logic (accounts, donors, volunteers, items, tasks)
assets/      Bootstrap template CSS, JS, images, and vendor libraries
forms/       Contact form handler
```

## Running it

1. Create a MySQL database called `ejood` and import your schema.
2. Replace the placeholder `your_db_password` in the PHP files with your own database password.
3. (Optional) set real SMS gateway credentials where used for task notifications.
4. Serve the folder with a PHP-enabled web server (XAMPP, Apache, etc.).
