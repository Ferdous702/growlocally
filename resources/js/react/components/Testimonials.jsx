import { testimonials } from "../data/content.js";

export default function Testimonials() {
  return (
    <section>
      <div className="wrap">
        <div className="sec-head reveal">
          <span className="eyebrow">Client words</span>
          <h2>The kind of reviews we like to earn</h2>
        </div>
        <div className="quotes reveal">
          {testimonials.map((t, i) => (
            <figure className="quote" key={i}>
              <span className="stars" aria-hidden="true">
                ★★★★★
              </span>
              <p>"{t.quote}"</p>
              <figcaption className="who">
                <span className="av" aria-hidden="true">
                  {t.initials}
                </span>
                <span>
                  <b>{t.name}</b>
                  <span>{t.role}</span>
                </span>
              </figcaption>
            </figure>
          ))}
        </div>
      </div>
    </section>
  );
}
