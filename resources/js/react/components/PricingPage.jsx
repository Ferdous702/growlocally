import { useEffect, useState } from "react";
import Header from "./Header.jsx";
import Footer from "./Footer.jsx";
import { useBooking } from "../context/BookingContext.jsx";
import {
  packages,
  serviceTabs,
  tabOrder,
  comparisonRows,
  comparisonCols,
} from "../data/pricingData.js";

const fmt = (n) => "£" + Number(n).toLocaleString("en-GB");

function Check({ stroke }) {
  return (
    <div className="check-wrap">
      <svg viewBox="0 0 10 10" fill="none">
        <path
          d="M1.5 5l2.5 2.5 4.5-5"
          stroke={stroke}
          strokeWidth="1.8"
          strokeLinecap="round"
          strokeLinejoin="round"
        />
      </svg>
    </div>
  );
}

function PackageCard({ pkg, annual, onCta }) {
  const price = annual ? pkg.priceAnnual : pkg.priceMonthly;
  return (
    <div className={`pkg-card ${pkg.theme}${pkg.popular ? " popular" : ""}`}>
      {pkg.popular && <div className="popular-badge">Most Popular</div>}
      <div className="pkg-top">
        <div
          className="pkg-step"
          style={pkg.stepStyle}
          dangerouslySetInnerHTML={{ __html: pkg.step }}
        />
        <span className="pkg-emoji">{pkg.emoji}</span>
        <div
          className="pkg-name"
          dangerouslySetInnerHTML={{ __html: pkg.name }}
        />
        <div className="pkg-tagline">{pkg.tagline}</div>
        <div className="pkg-price-label">{pkg.priceLabel}</div>
        <div className="pkg-price">
          <span>{fmt(price)}</span>
          {pkg.suffix && <span>{pkg.suffix}</span>}
        </div>
        <div className="pkg-price-note">{pkg.priceNote}</div>
        <div className="divider"></div>
      </div>
      <div className="pkg-features">
        <ul>
          {pkg.features.map((f, i) => (
            <li key={i} className={f.dim ? "dim" : undefined}>
              <Check stroke={f.dim ? "#94a3b8" : pkg.stroke} />
              <div
                className="feat-text"
                dangerouslySetInnerHTML={{ __html: f.t }}
              />
            </li>
          ))}
        </ul>
      </div>
      <div className="pkg-cta">
        <button
          className="cta-btn"
          onClick={onCta}
          dangerouslySetInnerHTML={{ __html: pkg.cta }}
        />
      </div>
    </div>
  );
}

function ServiceCard({ card, annual, onCta }) {
  const price = annual ? card.a : card.m;
  return (
    <div className={`svc-card ${card.c}`}>
      <div className="svc-card-top">
        <div className="svc-icon">{card.icon}</div>
        <div>
          <div
            className="svc-name"
            dangerouslySetInnerHTML={{ __html: card.name }}
          />
          <div className="svc-tag">{card.tag}</div>
        </div>
      </div>
      <div className="svc-desc" dangerouslySetInnerHTML={{ __html: card.desc }} />
      <ul className="svc-list">
        {card.list.map((li, i) => (
          <li key={i} dangerouslySetInnerHTML={{ __html: li }} />
        ))}
      </ul>
      <div className="svc-price">
        <span className="scp-val">{fmt(price)}</span>
        <span className="scp-per">{card.per}</span>
      </div>
      <button
        className="svc-btn"
        onClick={onCta}
        dangerouslySetInnerHTML={{ __html: card.btn }}
      />
    </div>
  );
}

function ComparisonTable() {
  const cats = [...new Set(comparisonRows.map((r) => r.cat))];
  return (
    <table style={{ width: "100%", borderCollapse: "collapse", minWidth: 700 }}>
      <thead>
        <tr>
          <th style={{ padding: "16px 20px", textAlign: "left", background: "#f8fafc", fontSize: ".78rem", fontWeight: 700, textTransform: "uppercase", letterSpacing: ".1em", color: "#64748b", borderBottom: "2px solid #e2e8f0", width: "32%" }}>
            Feature
          </th>
          {comparisonCols.map((col, i) => (
            <th key={i} style={{ padding: "16px 12px", textAlign: "center", background: col.popular ? "#fff7ed" : "#f8fafc", borderBottom: "2px solid #e2e8f0", position: col.popular ? "relative" : undefined }}>
              {col.popular && (
                <div style={{ position: "absolute", top: "-1px", left: "50%", transform: "translateX(-50%)", background: "#16a34a", color: "#fff", fontSize: ".6rem", fontWeight: 800, padding: "3px 10px", borderRadius: "0 0 8px 8px", whiteSpace: "nowrap" }}>
                  POPULAR
                </div>
              )}
              <div style={{ fontSize: ".82rem", fontWeight: 800, color: col.color, marginTop: col.popular ? 10 : 0 }}>
                {col.name}
              </div>
              <div style={{ fontSize: ".7rem", color: "#94a3b8", marginTop: 2 }}>
                {col.price}
              </div>
            </th>
          ))}
        </tr>
      </thead>
      <tbody>
        {cats.map((cat) => {
          const rows = comparisonRows.filter((r) => r.cat === cat);
          return (
            <Cat key={cat} cat={cat} rows={rows} />
          );
        })}
      </tbody>
    </table>
  );
}

function Cat({ cat, rows }) {
  return (
    <>
      <tr>
        <td colSpan={6} style={{ padding: "10px 20px", background: "#f1f5f9", fontSize: ".68rem", fontWeight: 700, textTransform: "uppercase", letterSpacing: ".12em", color: "#64748b", borderTop: "2px solid #e2e8f0" }}>
          {cat}
        </td>
      </tr>
      {rows.map((r, ri) => {
        const isLast = ri === rows.length - 1;
        const bb = isLast ? "transparent" : "#f1f5f9";
        return (
          <tr key={ri}>
            <td style={{ padding: "12px 20px", fontSize: ".8rem", fontWeight: 600, color: "#334155", borderBottom: `1px solid ${bb}` }}>
              {r.label}
            </td>
            {r.vals.map((v, i) => {
              const bg = i === 2 ? "#fff7ed" : "#fff";
              return (
                <td key={i} style={{ padding: 12, textAlign: "center", background: bg, borderBottom: `1px solid ${bb}` }}>
                  {v === "—" ? (
                    <span style={{ color: "#cbd5e1", fontSize: "1rem" }}>—</span>
                  ) : v === "✓" ? (
                    <span style={{ display: "inline-flex", alignItems: "center", justifyContent: "center", width: 22, height: 22, background: "#dcfce7", borderRadius: "50%" }}>
                      <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                        <path d="M1.5 5l2.5 2.5 4.5-5" stroke="#16a34a" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round" />
                      </svg>
                    </span>
                  ) : (
                    <span style={{ fontSize: ".75rem", fontWeight: 600, color: "#475569", background: "#f1f5f9", padding: "2px 8px", borderRadius: 999 }}>
                      {v}
                    </span>
                  )}
                </td>
              );
            })}
          </tr>
        );
      })}
    </>
  );
}

export default function PricingPage() {
  const { openBooking } = useBooking();
  const [tab, setTab] = useState("packages");
  const [annual, setAnnual] = useState(false);

  useEffect(() => {
    window.scrollTo(0, 0);
    const prev = document.title;
    document.title = "Pricing — GrowLocally";
    return () => {
      document.title = prev;
    };
  }, []);

  return (
    <div className="pricing-page">
      <Header />

      <section className="hero">
        <h1>
          Simple pricing for every <span>stage of growth</span>
        </h1>
        <p>
          Full packages or individual services — pick exactly what you need. No
          hidden fees, no lock-in.
        </p>
        <div className="billing-toggle">
          <button
            className={`tgl${annual ? "" : " act"}`}
            onClick={() => setAnnual(false)}
          >
            Monthly
          </button>
          <button
            className={`tgl${annual ? " act" : ""}`}
            onClick={() => setAnnual(true)}
          >
            Annual — Save 20%
          </button>
        </div>
      </section>

      <div className="tab-bar">
        <div className="tab-bar-inner">
          {tabOrder.map((t) => (
            <button
              key={t.id}
              className={`tab-btn${tab === t.id ? " act" : ""}`}
              onClick={() => setTab(t.id)}
            >
              {t.label}
            </button>
          ))}
        </div>
      </div>

      {/* PACKAGES */}
      <div className={`tab-panel${tab === "packages" ? " act" : ""}`}>
        <div className="wrap">
          <div className="pkg-grid" style={{ marginTop: 40 }}>
            {packages.map((pkg, i) => (
              <PackageCard key={i} pkg={pkg} annual={annual} onCta={openBooking} />
            ))}
          </div>
        </div>
      </div>

      {/* SERVICE TABS */}
      {Object.entries(serviceTabs).map(([id, data]) => (
        <div key={id} className={`tab-panel${tab === id ? " act" : ""}`}>
          <div className="wrap">
            <div className="section-label" style={{ marginTop: 40 }}>
              <div className="section-label-line"></div>
              <div className="section-label-text">{data.label}</div>
              <div className="section-label-line"></div>
            </div>
            <div className="svc-cards">
              {data.cards.map((card, i) => (
                <ServiceCard
                  key={i}
                  card={card}
                  annual={annual}
                  onCta={openBooking}
                />
              ))}
            </div>
          </div>
        </div>
      ))}

      {/* COMPARISON TABLE */}
      <section style={{ background: "#fff", padding: "60px 0" }}>
        <div className="wrap">
          <div style={{ textAlign: "center", marginBottom: 36 }}>
            <span style={{ fontSize: ".72rem", fontWeight: 700, textTransform: "uppercase", letterSpacing: ".14em", color: "#16a34a" }}>
              Compare Plans
            </span>
            <h2 style={{ fontSize: "1.6rem", fontWeight: 800, color: "#0f172a", margin: "8px 0" }}>
              Everything side by side
            </h2>
            <p style={{ color: "#64748b", fontSize: ".88rem" }}>
              See exactly what's included in each package before you decide.
            </p>
          </div>
          <div style={{ overflowX: "auto", borderRadius: 16, border: "2px solid #e2e8f0", boxShadow: "0 4px 20px rgba(0,0,0,.07)" }}>
            <ComparisonTable />
          </div>
        </div>
      </section>

      {/* CTA */}
      <section className="cta-band">
        <div className="wrap">
          <h2>Not sure which plan fits?</h2>
          <p>
            Book a free 30-minute call — we'll tell you exactly what will make
            the biggest difference for your business.
          </p>
          <button className="btn-white" onClick={openBooking}>
            Book your free strategy call →
          </button>
        </div>
      </section>

      <Footer />
    </div>
  );
}
