import { useState } from "react";
import { faqs } from "../data/content.js";

export default function Faq() {
  const [openIdx, setOpenIdx] = useState(null);

  return (
    <section className="alt">
      <div className="wrap">
        <div
          className="sec-head reveal"
          style={{ textAlign: "center", marginLeft: "auto", marginRight: "auto" }}
        >
          <span className="eyebrow" style={{ justifyContent: "center", display: "flex" }}>
            Good to know
          </span>
          <h2>Frequently asked questions</h2>
        </div>
        <div className="faq-list reveal">
          {faqs.map((item, i) => {
            const isOpen = openIdx === i;
            return (
              <details className="faq" key={i} open={isOpen}>
                <summary
                  style={{ listStyle: "none" }}
                  onClick={(e) => {
                    // Match the original: prevent native toggle and control
                    // open state ourselves so only the clicked item reacts.
                    e.preventDefault();
                    setOpenIdx(isOpen ? null : i);
                  }}
                >
                  <button type="button" aria-expanded={isOpen} tabIndex={-1}>
                    {item.q}
                    <span className="pm" aria-hidden="true"></span>
                  </button>
                </summary>
                <div className="ans">
                  {item.hasPricingLink ? (
                    <>
                      We offer transparent monthly plans to suit different
                      stages of growth. You can see full details on our{" "}
                      <a href="#/pricing" className="link-underline">
                        pricing page
                      </a>
                      , or book a free call for a tailored recommendation.
                    </>
                  ) : (
                    item.a
                  )}
                </div>
              </details>
            );
          })}
        </div>
      </div>
    </section>
  );
}
