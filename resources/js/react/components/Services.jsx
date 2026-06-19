import { ServiceIcon } from "./icons.jsx";

const services = [
  {
    title: "Local SEO",
    body: "Rank for the searches your customers actually make in your town, city and surrounding area.",
  },
  {
    title: "Google Business Profile",
    body: "Own the map pack with an optimised, review-rich profile that turns searches into footfall and calls.",
  },
  {
    title: "Google & Meta Ads",
    body: "Paid campaigns that put you in front of ready-to-buy customers, with every pound tracked to results.",
  },
  {
    title: "Social Media",
    body: "Content and community management that keeps your brand visible and your audience engaged.",
  },
  {
    title: "Web Design",
    body: "Fast, mobile-first websites built to convert visitors into enquiries — and to keep Google happy.",
  },
  {
    title: "Content & SEO",
    body: "Helpful, search-optimised content that builds authority and answers what your customers are asking.",
  },
];

export default function Services() {
  return (
    <section>
      <div className="wrap">
        <div className="sec-head reveal">
          <span className="eyebrow">What we do</span>
          <h2>Everything a local business needs to be found online</h2>
          <p>
            Six core services, working together as one growth engine. Pick the
            ones you need now and add more as you scale — explore each in detail
            on our{" "}
            <a href="#/services" className="link-underline">
              services page
            </a>
            .
          </p>
        </div>
        <div className="svc-grid reveal">
          {services.map((svc, i) => (
            <article className="svc" key={i}>
              <span className="num">{String(i + 1).padStart(2, "0")}</span>
              <span className="ic" aria-hidden="true">
                <ServiceIcon index={i} />
              </span>
              <h3>{svc.title}</h3>
              <p>{svc.body}</p>
              <a href="#/services" className="more">
                Explore →
              </a>
            </article>
          ))}
        </div>
      </div>
    </section>
  );
}
