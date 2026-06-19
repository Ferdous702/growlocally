import { useState } from "react";
import { navLinks } from "../data/content.js";
import { useBooking } from "../context/BookingContext.jsx";

export default function Header() {
  const [open, setOpen] = useState(false);
  const { openBooking } = useBooking();

  // The original toggles `mobile-open` on <body>; the CSS selectors target
  // `.mobile-open nav.primary`, so we mirror that by toggling the body class.
  function toggleMenu() {
    const next = !open;
    setOpen(next);
    document.body.classList.toggle("mobile-open", next);
  }

  // Close the mobile menu (if open) and open the booking modal.
  function handleAudit() {
    if (open) {
      setOpen(false);
      document.body.classList.remove("mobile-open");
    }
    openBooking();
  }

  return (
    <header className="site" id="top">
      <div className="wrap nav">
        <a className="brand" href="#/" aria-label="GrowLocally home">
          <img className="brand-logo" src="/logo.png" alt="GrowLocally" />
          Grow<b>Locally</b>
        </a>

        <nav className="primary" aria-label="Primary">
          <ul>
            {navLinks.map((link) => (
              <li key={link.href}>
                <a href={link.href}>{link.label}</a>
              </li>
            ))}
            <li className="mobile-cta">
              <button
                type="button"
                className="btn btn-brand"
                onClick={handleAudit}
              >
                Get a free audit ↗
              </button>
            </li>
          </ul>
        </nav>

        <div className="nav-cta">
          <button
            type="button"
            className="btn btn-primary"
            onClick={handleAudit}
          >
            Get a free audit{" "}
            <span className="arr" aria-hidden="true">
              ↗
            </span>
          </button>
          <button
            className="menu-btn"
            aria-label="Open menu"
            aria-expanded={open}
            onClick={toggleMenu}
          >
            <span></span>
            <span></span>
            <span></span>
          </button>
        </div>
      </div>
    </header>
  );
}
