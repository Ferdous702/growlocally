export default function About() {
  return (
    <section>
      <div className="wrap about">
        <div className="photo reveal" aria-hidden="true">
          <div className="badge">
            Legacy or launch.
            <br />
            We grow
            <br />
            both.
          </div>
        </div>
        <div className="reveal">
          <span className="eyebrow">Our story</span>
          <h2>
            Built for businesses that are starting up{" "}
            <span className="mark">and</span> those that have been around for
            years
          </h2>
          <p>
            As the world moved online, we noticed two groups being left behind:
            long-standing local businesses with years of reputation but no
            digital identity, quietly fading from a market that now searches
            before it steps outside — and ambitious newcomers with great ideas
            but no foothold in an increasingly crowded space.
          </p>
          <p>
            We started GrowLocally to serve both. Whether you're protecting a
            legacy or building one from scratch, we give you the digital
            presence, visibility and strategy to compete, grow and own your
            local market.
          </p>
          <a href="/about-us" className="btn btn-primary">
            More about us{" "}
            <span className="arr" aria-hidden="true">
              ↗
            </span>
          </a>
        </div>
      </div>
    </section>
  );
}
