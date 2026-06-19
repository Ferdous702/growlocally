import { caseMetrics } from "../data/content.js";

export default function CaseStudy() {
  return (
    <section>
      <div className="wrap">
        <div className="sec-head reveal">
          <span className="eyebrow">Proof, not promises</span>
          <h2>Real results for real local businesses</h2>
        </div>
        <div className="case reveal">
          <div>
            <blockquote>
              "Within four months we'd doubled our enquiries and finally showed
              up first on Google for our area. GrowLocally just gets it."
            </blockquote>
            <cite>— Independent home-services business, the Midlands</cite>
          </div>
          <div className="metrics">
            {caseMetrics.map((m, i) => (
              <div className="m" key={i}>
                <div className="n">{m.n}</div>
                <div className="l">{m.l}</div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}
