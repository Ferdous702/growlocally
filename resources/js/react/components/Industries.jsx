import { industries } from "../data/content.js";

export default function Industries() {
  return (
    <section className="alt">
      <div className="wrap">
        <div className="sec-head reveal">
          <span className="eyebrow">Who we help</span>
          <h2>Built for local, service-led businesses</h2>
          <p>
            If your customers are nearby and search before they buy, we can help
            you grow.
          </p>
        </div>
        <div className="tags reveal">
          {industries.map((tag, i) => (
            <span className="tag" key={i}>
              {tag}
            </span>
          ))}
        </div>
      </div>
    </section>
  );
}
