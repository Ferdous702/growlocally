import { CheckIcon } from "./icons.jsx";
import { whyItems } from "../data/content.js";

export default function WhyUs() {
  return (
    <section className="alt">
      <div className="wrap">
        <div className="sec-head reveal">
          <span className="eyebrow">Why GrowLocally</span>
          <h2>
            Marketing power <span className="mark shade">and</span> technical
            expertise — under one roof
          </h2>
          <p>
            Most agencies do one or the other. We do both. From getting you
            found on Google to building the tech that runs your business — we're
            the only partner you need.
          </p>
        </div>
        <div className="why-grid reveal">
          {whyItems.map((item, i) => (
            <div className="why" key={i}>
              <span className="tick" aria-hidden="true">
                <CheckIcon />
              </span>
              <div>
                <h3>{item.title}</h3>
                <p>{item.body}</p>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
