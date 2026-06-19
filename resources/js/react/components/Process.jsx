import { steps } from "../data/content.js";

export default function Process() {
  return (
    <section className="ink-sec">
      <div className="wrap">
        <div className="sec-head reveal">
          <span className="eyebrow">How we work</span>
          <h2 style={{ color: "#fff" }}>A simple, proven path to growth</h2>
          <p>
            No mystery, no months of waiting. Four clear stages that get you
            live and growing fast.
          </p>
        </div>
        <div className="steps reveal">
          {steps.map((step, i) => (
            <div className="step" key={i}>
              <div className="bar"></div>
              <h3>{step.title}</h3>
              <p>{step.body}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
