import { useEffect } from "react";
import Header from "./Header.jsx";
import Footer from "./Footer.jsx";

export default function LegalPage({ page }) {
  // Start at the top and set the document title for SEO when the page mounts.
  useEffect(() => {
    window.scrollTo(0, 0);
    const prev = document.title;
    document.title = `${page.title} — GrowLocally`;
    return () => {
      document.title = prev;
    };
  }, [page]);

  return (
    <div className="legal-page">
      <Header />
      <main>
        <section className="legal-hero">
          <div className="wrap legal-hero-inner">
            <div className="legal-crumb">
              <a href="#/">Home</a> › <span>{page.title}</span>
            </div>
            <h1>{page.title}</h1>
            <div className="legal-updated">Last updated: {page.updated}</div>
          </div>
        </section>

        <section className="legal-body">
          <div className="wrap">
            <div className="legal-inner">
              <p className="legal-intro">{page.intro}</p>

              {page.sections.map((sec, i) => (
                <div className="legal-section" key={i}>
                  <h2>{sec.h}</h2>
                  {sec.body?.map((para, j) => (
                    <p key={j}>{para}</p>
                  ))}
                  {sec.list && (
                    <ul>
                      {sec.list.map((item, k) => (
                        <li key={k}>{item}</li>
                      ))}
                    </ul>
                  )}
                  {sec.contact && (
                    <div className="legal-contact-box">
                      <p>
                        <strong>GrowLocally Ltd</strong>
                      </p>
                      <p>
                        Email:{" "}
                        <a href="mailto:hello@growlocally.co.uk">
                          hello@growlocally.co.uk
                        </a>
                      </p>
                      <p>United Kingdom</p>
                    </div>
                  )}
                </div>
              ))}
            </div>
          </div>
        </section>
      </main>
      <Footer />
    </div>
  );
}
