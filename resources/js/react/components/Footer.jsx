export default function Footer() {
  const year = new Date().getFullYear();

  return (
    <footer className="site">
      <div className="wrap">
        <div className="foot-grid">
          {/* Brand + positioning */}
          <div className="foot-brand-col">
            <a className="brand" href="#/" aria-label="GrowLocally home">
              <img
                className="brand-logo"
                src="/logo-footer.png"
                alt="GrowLocally"
              />
              Grow<b style={{ color: "var(--accent)" }}>Locally</b>
            </a>
            <p className="blurb">
              A UK digital growth partner for local businesses — combining
              marketing, web development, apps and automation under one roof. We
              help you get found, get chosen and grow, with honest advice and no
              lock-in contracts.
            </p>
            <div className="foot-pillars" aria-hidden="true">
              <span>SEO</span>
              <span>Marketing</span>
              <span>Web &amp; Apps</span>
              <span>Automation</span>
            </div>
          </div>

          {/* What we do — the four pillars */}
          <div className="foot-col">
            <h4>What we do</h4>
            <ul>
              <li><a href="#/services">Search Engine Optimisation</a></li>
              <li><a href="#/services">Digital Marketing &amp; Ads</a></li>
              <li><a href="#/services">Web Development &amp; Hosting</a></li>
              <li><a href="#/services">Apps, AI &amp; Automation</a></li>
            </ul>
          </div>

          {/* Capabilities — a fuller spread of the work */}
          <div className="foot-col">
            <h4>Capabilities</h4>
            <ul>
              <li><a href="#/services">Local SEO &amp; Google Profile</a></li>
              <li><a href="#/services">Google &amp; Meta Ads</a></li>
              <li><a href="#/services">Social Media &amp; Email</a></li>
              <li><a href="#/services">Branding &amp; Web Design</a></li>
              <li><a href="#/services">CRM &amp; Lead Automation</a></li>
              <li><a href="#/services">Mobile &amp; Web Apps</a></li>
            </ul>
          </div>

          {/* Company */}
          <div className="foot-col">
            <h4>Company</h4>
            <ul>
              <li><a href="/about-us">About Us</a></li>
              <li><a href="#/services">All Services</a></li>
              <li><a href="#/pricing">Pricing</a></li>
              <li><a href="/contact">Contact</a></li>
              <li><a href="#/privacy-policy">Privacy Policy</a></li>
              <li><a href="#/terms-of-service">Terms of Service</a></li>
              <li><a href="#/cookie-policy">Cookie Policy</a></li>
            </ul>
          </div>

          {/* Contact */}
          <div className="foot-col foot-contact">
            <h4>Get in touch</h4>
            <a href="mailto:hello@growlocally.co.uk">hello@growlocally.co.uk</a>
            <a href="tel:+440000000000">Call our team</a>
            <a
              href="/contact"
              className="link-underline"
              style={{ color: "var(--accent)", borderColor: "var(--accent)" }}
            >
              Book a free audit →
            </a>
          </div>
        </div>

        <div className="foot-bottom">
          <span>© {year} GrowLocally Ltd. All rights reserved.</span>
          <span className="legal">
            <a href="#/privacy-policy">Privacy</a>
            <a href="#/terms-of-service">Terms</a>
            <a href="#/cookie-policy">Cookies</a>
          </span>
          <span className="made">Made in the UK 🇬🇧</span>
        </div>
      </div>
    </footer>
  );
}
