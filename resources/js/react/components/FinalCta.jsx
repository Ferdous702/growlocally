import { useBooking } from "../context/BookingContext.jsx";

export default function FinalCta() {
  const { openBooking } = useBooking();
  return (
    <section className="cta-final">
      <div className="wrap reveal">
        <span
          className="eyebrow"
          style={{
            color: "#fff",
            justifyContent: "center",
            display: "flex",
          }}
        >
          Ready when you are
        </span>
        <h2>Let's grow your business, locally.</h2>
        <p>
          Book a free, no-obligation strategy call and we'll show you exactly
          where your biggest opportunities are.
        </p>
        <div
          style={{
            display: "flex",
            gap: "14px",
            justifyContent: "center",
            flexWrap: "wrap",
          }}
        >
          <button type="button" className="btn btn-ghost" onClick={openBooking}>
            Book your free call{" "}
            <span className="arr" aria-hidden="true">
              ↗
            </span>
          </button>
          <a href="#/services" className="btn btn-ghost">
            Explore services
          </a>
        </div>
      </div>
    </section>
  );
}
