import { useEffect } from "react";
import Header from "./Header.jsx";
import Footer from "./Footer.jsx";
import ServiceTable from "./ServiceTable.jsx";
import { useReveal } from "../hooks/useReveal.js";
import { useBooking } from "../context/BookingContext.jsx";
import { serviceSections } from "../data/servicesData.js";

function ImageCard({ section }) {
  return (
    <div className="img-card">
      <img src={section.image} alt={section.imageAlt} loading="lazy" />
      <div className="img-card-body">
        <h4>{section.cardTitle}</h4>
        <p>{section.cardText}</p>
        <span className={`tag ${section.tagClass}`}>
          {section.rows.length} Services Available
        </span>
      </div>
    </div>
  );
}

export default function ServicesPage() {
  const { openBooking } = useBooking();

  // Re-run reveal observer for this page's elements, and start at the top.
  useReveal();
  useEffect(() => {
    window.scrollTo(0, 0);
  }, []);

  return (
    <div className="services-page">
      <Header />
      <main>
        {/* HERO */}
        <section className="svc-hero">
          <div className="wrap svc-hero-inner">
            <div className="crumb">
              <a href="#/">Home</a> › <span>Services</span>
            </div>
            <h1>
              Four pillars of <em>complete digital growth</em>
            </h1>
            <p>
              From search rankings and paid campaigns to custom-built apps and
              intelligent automation — everything your business needs, under one
              roof.
            </p>
            <div className="hero-cats">
              <span className="cat-pill cp1">01 — SEO Support</span>
              <span className="cat-pill cp2">02 — Digital Marketing</span>
              <span className="cat-pill cp3">03 — Technical Support</span>
              <span className="cat-pill cp4">04 — App &amp; Automation</span>
            </div>
          </div>
        </section>

        {/* FOUR SERVICE SECTIONS */}
        {serviceSections.map((section) => (
          <section
            key={section.id}
            className={`svc-section${section.alt ? " alt" : ""}`}
            id={section.id}
          >
            <div className="wrap">
              <div className="sec-head reveal">
                <div className={`svc-eyebrow ${section.eyebrowClass}`}>
                  {section.number}
                </div>
                <h2>{section.title}</h2>
                <p>{section.intro}</p>
              </div>
              <div
                className={`split reveal${section.imageRight ? "" : " rev"}`}
              >
                {section.imageRight ? (
                  <>
                    <ServiceTable section={section} />
                    <ImageCard section={section} />
                  </>
                ) : (
                  <>
                    <ImageCard section={section} />
                    <ServiceTable section={section} />
                  </>
                )}
              </div>
            </div>
          </section>
        ))}

        {/* CTA BAND */}
        <section className="cta-band">
          <div className="wrap reveal">
            <h2>Not sure where to start?</h2>
            <p>
              Book a free 30-minute strategy call. We'll review your current
              setup and tell you exactly which services will make the biggest
              difference.
            </p>
            <button
              className="btn-outline"
              type="button"
              onClick={openBooking}
            >
              Book your free audit →
            </button>
          </div>
        </section>
      </main>
      <Footer />
    </div>
  );
}
