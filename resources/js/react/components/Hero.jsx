import { useEffect, useRef, useState } from "react";
import { SearchIcon } from "./icons.jsx";
import { heroKeywords } from "../data/content.js";
import { useBooking } from "../context/BookingContext.jsx";

const benefits = [
  {
    icon: "👀",
    number: "More Eyes On You",
    label: "More enquiries, more customers",
    sub: "Our clients consistently see a significant jump in calls, messages & walk-ins",
    wide: false,
  },
  {
    icon: "📍",
    number: "#1",
    label: "On Google Maps & Search",
    sub: "We get your business to the top of local results — maps, search & beyond",
    wide: false,
  },
  {
    icon: "🌐",
    number: "Web+App",
    label: "Website & app design",
    sub: "Beautiful, conversion-ready sites & apps built for UK locals",
    wide: false,
  },
  {
    icon: "📣",
    number: "Campaigns",
    label: "Ads that pay for themselves",
    sub: "Google, Meta & email campaigns built to bring in more than they cost",
    wide: false,
  },
  {
    icon: "🤖",
    number: "AI",
    label: "AI automation",
    sub: "Cut manual work with smart automations — from follow-ups and booking reminders to lead nurturing, all running 24/7 without lifting a finger",
    wide: true,
  },
  {
    icon: "🚀",
    number: "Launch",
    label: "We build startups from scratch",
    sub: "Just getting started? We help startups build their brand, launch their online presence, and get their first customers — all from the ground up",
    wide: true,
  },
];

export default function Hero() {
  const { openBooking } = useBooking();
  const [idx, setIdx] = useState(0);
  const kwRef = useRef(null);

  // Rotate the simulated search keyword with the same fade timing as the
  // original (300ms fade out, 2800ms interval).
  useEffect(() => {
    const interval = setInterval(() => {
      const el = kwRef.current;
      if (el) el.style.opacity = "0";
      setTimeout(() => {
        setIdx((i) => (i + 1) % heroKeywords.length);
        if (el) el.style.opacity = "1";
      }, 300);
    }, 2800);
    return () => clearInterval(interval);
  }, []);

  return (
    <section className="hero">
      <div className="hero-body">
        <div className="wrap hero-grid">
          {/* LEFT: headline + CTA */}
          <div className="hero-left">
            <div className="hero-badge">
              <SearchIcon />
              Your All-in-One Digital Growth Partner
            </div>

            <h1>
              Your local business,
              <br />
              <span className="line2">ranked &amp; growing.</span>
            </h1>

            {/* simulated search bar */}
            <div className="hero-keyword-row" aria-hidden="true">
              <div className="kw-wrap">
                <span className="kw-icon">🔍</span>
                <span className="kw-text" ref={kwRef}>
                  {heroKeywords[idx]}
                </span>
              </div>
              <span className="kw-rank">RANK #1</span>
            </div>

            <p className="lede">
              We turn "near me" searches into booked customers — with Local SEO,
              Google Ads, web design, CRM systems, and targeted campaigns built
              for UK businesses. Whether you're an established local brand or a
              startup finding your footing, we build the digital foundation you
              need to grow.
            </p>

            <div className="hero-cta">
              <button
                type="button"
                className="btn btn-brand"
                onClick={openBooking}
              >
                Book a free strategy call{" "}
                <span className="arr" aria-hidden="true">
                  ↗
                </span>
              </button>
              <a
                href="#/services"
                className="btn"
                style={{
                  background: "rgba(255,255,255,.08)",
                  color: "#fff",
                  borderColor: "rgba(255,255,255,.15)",
                }}
              >
                See our services
              </a>
            </div>
          </div>

          {/* RIGHT: benefit cards */}
          <aside
            className="hero-benefits"
            aria-label="What you get with GrowLocally"
          >
            {benefits.map((b, i) => (
              <div
                key={i}
                className={`benefit-card${b.wide ? " bc-wide" : ""}`}
              >
                <div className="bc-icon">{b.icon}</div>
                <div className="bc-body">
                  <div className="bc-number">{b.number}</div>
                  <div className="bc-label">{b.label}</div>
                  <div className="bc-sub">{b.sub}</div>
                </div>
              </div>
            ))}
          </aside>
        </div>
      </div>
    </section>
  );
}
