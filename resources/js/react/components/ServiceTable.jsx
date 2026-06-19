import { useEffect, useRef, useState } from "react";
import { badgeMeta } from "../data/servicesData.js";

const COLLAPSED_ROWS = 5;

export default function ServiceTable({ section }) {
  const bodyRef = useRef(null);
  const [open, setOpen] = useState(false);
  const [collapsedH, setCollapsedH] = useState(null);
  const [fullH, setFullH] = useState(null);

  // Measure the collapsed (header + first 5 rows) and full heights after
  // layout, mirroring the original initTable(). Re-measure on resize.
  useEffect(() => {
    function measure() {
      const body = bodyRef.current;
      if (!body) return;
      const thead = body.querySelector("thead tr");
      const rows = body.querySelectorAll("tbody tr");
      const theadH = thead ? thead.offsetHeight : 0;
      let collapsed = 0;
      for (let i = 0; i < Math.min(COLLAPSED_ROWS, rows.length); i++) {
        collapsed += rows[i].offsetHeight;
      }
      setCollapsedH(theadH + collapsed);
      setFullH(body.scrollHeight);
    }
    measure();
    window.addEventListener("resize", measure);
    return () => window.removeEventListener("resize", measure);
  }, []);

  const total = section.rows.length;
  const maxHeight = open ? fullH : collapsedH;

  return (
    <div className="tbl-wrap">
      <div
        className={`tbl-body${open ? " open" : ""}`}
        ref={bodyRef}
        style={maxHeight != null ? { maxHeight: `${maxHeight}px` } : undefined}
      >
        <table>
          <thead>
            <tr className={section.thClass}>
              <th>Service</th>
              <th>What It Includes</th>
            </tr>
          </thead>
          <tbody>
            {section.rows.map(([name, badge, includes], i) => {
              const meta = badge ? badgeMeta[badge] : null;
              return (
                <tr key={i}>
                  <td>
                    {name}
                    {meta && (
                      <span className={`badge ${meta.cls}`}>{meta.label}</span>
                    )}
                  </td>
                  <td>{includes}</td>
                </tr>
              );
            })}
          </tbody>
        </table>
        <div className="tbl-fade"></div>
      </div>
      <button
        className={`tbl-toggle${open ? " open" : ""}`}
        onClick={() => setOpen((o) => !o)}
        type="button"
      >
        <span className="lbl">
          {open ? "Show less" : `See all ${total} services`}
        </span>
        <svg
          className="arr"
          width="16"
          height="16"
          viewBox="0 0 16 16"
          fill="none"
        >
          <path
            d="M3 6l5 5 5-5"
            stroke="currentColor"
            strokeWidth="1.8"
            strokeLinecap="round"
            strokeLinejoin="round"
          />
        </svg>
      </button>
    </div>
  );
}
