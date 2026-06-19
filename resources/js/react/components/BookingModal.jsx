import { useEffect, useRef, useState } from "react";
import { useBooking } from "../context/BookingContext.jsx";

const services = [
  "Local SEO",
  "Google Business Profile",
  "Google & Meta Ads",
  "Social Media",
  "Web Design",
  "Content & SEO",
  "Not sure yet — help me decide",
];

const emptyForm = {
  name: "",
  email: "",
  phone: "",
  business: "",
  service: "",
  date: "",
  time: "",
  message: "",
};

export default function BookingModal() {
  const { isOpen, closeBooking } = useBooking();
  const [form, setForm] = useState(emptyForm);
  const [errors, setErrors] = useState({});
  const [submitted, setSubmitted] = useState(false);
  const [sending, setSending] = useState(false);
  const dialogRef = useRef(null);
  const firstFieldRef = useRef(null);

  // Close on Escape, lock body scroll, and focus the first field on open.
  useEffect(() => {
    if (!isOpen) return;
    document.body.style.overflow = "hidden";
    const onKey = (e) => {
      if (e.key === "Escape") closeBooking();
    };
    document.addEventListener("keydown", onKey);
    const t = setTimeout(() => firstFieldRef.current?.focus(), 60);
    return () => {
      document.body.style.overflow = "";
      document.removeEventListener("keydown", onKey);
      clearTimeout(t);
    };
  }, [isOpen, closeBooking]);

  // Reset to a clean form shortly after the modal closes.
  useEffect(() => {
    if (isOpen) return;
    const t = setTimeout(() => {
      setForm(emptyForm);
      setErrors({});
      setSubmitted(false);
      setSending(false);
    }, 250);
    return () => clearTimeout(t);
  }, [isOpen]);

  if (!isOpen) return null;

  function update(field, value) {
    setForm((f) => ({ ...f, [field]: value }));
    if (errors[field]) setErrors((e) => ({ ...e, [field]: undefined }));
  }

  function validate() {
    const next = {};
    if (!form.name.trim()) next.name = "Please enter your name.";
    if (!form.email.trim()) {
      next.email = "Please enter your email.";
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email)) {
      next.email = "That email doesn't look right.";
    }
    if (!form.service) next.service = "Please choose a service.";
    return next;
  }

  async function handleSubmit(e) {
    e.preventDefault();
    const next = validate();
    setErrors(next);
    if (Object.keys(next).length > 0) {
      const firstKey = Object.keys(next)[0];
      dialogRef.current
        ?.querySelector(`[name="${firstKey}"]`)
        ?.focus();
      return;
    }
    setSending(true);
    try {
      const response = await fetch("/api/bookings", {
        method: "POST",
        headers: { "Content-Type": "application/json", Accept: "application/json" },
        body: JSON.stringify({
          name:     form.name,
          business: form.business,
          email:    form.email,
          phone:    form.phone,
          service:  form.service,
          date:     form.date,
          time:     form.time,
          message:  form.message,
        }),
      });
      const data = await response.json();
      if (!response.ok) {
        if (response.status === 422 && data.errors) {
          const serverErrors = {};
          for (const [key, messages] of Object.entries(data.errors)) {
            serverErrors[key] = Array.isArray(messages) ? messages[0] : messages;
          }
          setErrors(serverErrors);
        } else {
          setErrors({ name: data.message || "Something went wrong. Please try again." });
        }
        return;
      }
      setSubmitted(true);
    } catch {
      setErrors({ name: "Unable to send your request. Please check your connection and try again." });
    } finally {
      setSending(false);
    }
  }

  function onBackdrop(e) {
    if (e.target === e.currentTarget) closeBooking();
  }

  return (
    <div className="booking-backdrop" onMouseDown={onBackdrop}>
      <div
        className="booking-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="booking-title"
        ref={dialogRef}
      >
        <button
          className="booking-close"
          onClick={closeBooking}
          aria-label="Close booking form"
          type="button"
        >
          ×
        </button>

        {submitted ? (
          <div className="booking-success">
            <div className="booking-success-mark" aria-hidden="true">
              <svg viewBox="0 0 24 24">
                <path d="m5 12 5 5L20 6" />
              </svg>
            </div>
            <h3 id="booking-title">You're booked in</h3>
            <p>
              Thanks {form.name.split(" ")[0] || "there"} — we've got your
              request. A member of the team will email you at{" "}
              <strong>{form.email}</strong> within one working day to confirm
              your free strategy call.
            </p>
            <button className="btn btn-brand booking-done" onClick={closeBooking}>
              Done
            </button>
          </div>
        ) : (
          <>
            <div className="booking-head">
              <span className="eyebrow">Free strategy call</span>
              <h3 id="booking-title">Book your free call</h3>
              <p>
                Tell us a little about your business and we'll show you where
                your biggest opportunities are. No obligation, no hard sell.
              </p>
            </div>

            <form className="booking-form" onSubmit={handleSubmit} noValidate>
              <div className="bf-row">
                <div className="bf-field">
                  <label htmlFor="bf-name">Your name *</label>
                  <input
                    id="bf-name"
                    name="name"
                    type="text"
                    ref={firstFieldRef}
                    value={form.name}
                    onChange={(e) => update("name", e.target.value)}
                    aria-invalid={!!errors.name}
                    placeholder="Jane Smith"
                  />
                  {errors.name && <span className="bf-error">{errors.name}</span>}
                </div>
                <div className="bf-field">
                  <label htmlFor="bf-business">Business name</label>
                  <input
                    id="bf-business"
                    name="business"
                    type="text"
                    value={form.business}
                    onChange={(e) => update("business", e.target.value)}
                    placeholder="Smith & Co."
                  />
                </div>
              </div>

              <div className="bf-row">
                <div className="bf-field">
                  <label htmlFor="bf-email">Email *</label>
                  <input
                    id="bf-email"
                    name="email"
                    type="email"
                    value={form.email}
                    onChange={(e) => update("email", e.target.value)}
                    aria-invalid={!!errors.email}
                    placeholder="jane@business.co.uk"
                  />
                  {errors.email && (
                    <span className="bf-error">{errors.email}</span>
                  )}
                </div>
                <div className="bf-field">
                  <label htmlFor="bf-phone">Phone</label>
                  <input
                    id="bf-phone"
                    name="phone"
                    type="tel"
                    value={form.phone}
                    onChange={(e) => update("phone", e.target.value)}
                    placeholder="07700 900000"
                  />
                </div>
              </div>

              <div className="bf-field">
                <label htmlFor="bf-service">What do you need help with? *</label>
                <select
                  id="bf-service"
                  name="service"
                  value={form.service}
                  onChange={(e) => update("service", e.target.value)}
                  aria-invalid={!!errors.service}
                >
                  <option value="">Select a service…</option>
                  {services.map((s) => (
                    <option key={s} value={s}>
                      {s}
                    </option>
                  ))}
                </select>
                {errors.service && (
                  <span className="bf-error">{errors.service}</span>
                )}
              </div>

              <div className="bf-row">
                <div className="bf-field">
                  <label htmlFor="bf-date">Preferred date</label>
                  <input
                    id="bf-date"
                    name="date"
                    type="date"
                    value={form.date}
                    onChange={(e) => update("date", e.target.value)}
                  />
                </div>
                <div className="bf-field">
                  <label htmlFor="bf-time">Preferred time</label>
                  <select
                    id="bf-time"
                    name="time"
                    value={form.time}
                    onChange={(e) => update("time", e.target.value)}
                  >
                    <option value="">Any time</option>
                    <option value="morning">Morning (9am–12pm)</option>
                    <option value="afternoon">Afternoon (12pm–5pm)</option>
                    <option value="evening">Evening (5pm–7pm)</option>
                  </select>
                </div>
              </div>

              <div className="bf-field">
                <label htmlFor="bf-message">Anything else? (optional)</label>
                <textarea
                  id="bf-message"
                  name="message"
                  rows={3}
                  value={form.message}
                  onChange={(e) => update("message", e.target.value)}
                  placeholder="A quick line about your goals or current setup."
                />
              </div>

              <button
                type="submit"
                className="btn btn-brand booking-submit"
                disabled={sending}
              >
                {sending ? "Sending…" : "Book my free call"}
                {!sending && (
                  <span className="arr" aria-hidden="true">
                    ↗
                  </span>
                )}
              </button>
              <p className="bf-fineprint">
                We'll only use your details to arrange your call. No spam, ever.
              </p>
            </form>
          </>
        )}
      </div>
    </div>
  );
}
