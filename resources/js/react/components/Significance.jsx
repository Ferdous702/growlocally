import { stats } from "../data/content.js";

export default function Significance() {
  return (
    <section className="alt">
      <div className="wrap">
        <div className="sec-head reveal">
          <span className="eyebrow">Why it matters</span>
          <h2>The world moved online. Your business needs to move with it.</h2>
          <p>
            Customers today don't ask friends — they search Google, scroll
            social media, and decide in seconds. Businesses that show up, load
            fast, follow up smartly, and look credible online are the ones that
            win. We give you every tool to be that business.
          </p>
        </div>
        <div className="stats reveal">
          {stats.map((s, i) => (
            <div className="stat" key={i}>
              <div className="n">{s.n}</div>
              <div className="l">{s.l}</div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
