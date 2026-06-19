import { useEffect, useState } from "react";

// Minimal hash-based router: reads location.hash and re-renders on change.
// Routes used: "#/" (home) and "#/services". No external dependency needed,
// and it works on static hosts without server-side rewrites.
export function useHashRoute() {
  const [route, setRoute] = useState(() => normalize(window.location.hash));

  useEffect(() => {
    const onChange = () => setRoute(normalize(window.location.hash));
    window.addEventListener("hashchange", onChange);
    return () => window.removeEventListener("hashchange", onChange);
  }, []);

  return route;
}

function normalize(hash) {
  // "#/services" -> "/services", "" or "#" -> "/"
  const h = (hash || "").replace(/^#/, "");
  return h === "" ? "/" : h;
}
