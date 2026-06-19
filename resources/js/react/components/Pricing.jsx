import { plans } from "../data/content.js";

export default function Pricing() {
  return (
    <section className="alt">
      <div className="wrap">
        <div
          className="sec-head reveal"
          style={{ textAlign: "center", marginLeft: "auto", marginRight: "auto" }}
        >
          <span className="eyebrow" style={{ justifyContent: "center", display: "flex" }}>
            Simple pricing
          </span>
          <h2>Plans that grow with you</h2>
          <p>
            Transparent monthly plans with no hidden fees and no lock-in. See
            full inclusions and pricing on our{" "}
            <a href="#/pricing" className="link-underline">
              pricing page
            </a>
            .
          </p>
        </div>
        <div className="plans reveal">
          {plans.map((plan, i) => (
            <div className={`plan${plan.featured ? " feat" : ""}`} key={i}>
              <span className="from">{plan.from}</span>
              <h3>{plan.name}</h3>
              <p
                style={
                  plan.featured
                    ? { fontSize: ".97rem" }
                    : { color: "var(--ink-soft)", fontSize: ".97rem" }
                }
              >
                {plan.blurb}
              </p>
              <ul>
                {plan.features.map((f, fi) => (
                  <li key={fi}>{f}</li>
                ))}
              </ul>
              {plan.featured ? (
                <a
                  href="#/pricing"
                  className="btn btn-brand"
                  style={{
                    width: "100%",
                    justifyContent: "center",
                    background: "var(--accent)",
                    color: "var(--ink)",
                  }}
                >
                  View plans
                </a>
              ) : (
                <a
                  href="#/pricing"
                  className="btn btn-ghost"
                  style={{ width: "100%", justifyContent: "center" }}
                >
                  View plans
                </a>
              )}
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
