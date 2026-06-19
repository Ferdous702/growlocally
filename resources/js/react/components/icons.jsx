// Inline SVG icons. Kept as small components so JSX stays readable and the
// exact paths from the original markup are preserved.

export function LeafLogo({ stroke = "#7ED9A0" }) {
  return (
    <svg
      viewBox="0 0 24 24"
      fill="none"
      stroke={stroke}
      strokeWidth="2"
      strokeLinecap="round"
      strokeLinejoin="round"
    >
      <path d="M12 21V9" />
      <path d="M12 9c0-3 2-5 5-5 0 3-2 5-5 5z" />
      <path d="M12 12C12 9 10 7 7 7c0 3 2 5 5 5z" />
    </svg>
  );
}

export function SearchIcon() {
  return (
    <svg viewBox="0 0 24 24">
      <circle cx="11" cy="11" r="7" />
      <path d="m21 21-4.3-4.3" />
    </svg>
  );
}

export function CheckIcon() {
  return (
    <svg viewBox="0 0 24 24">
      <path d="m5 12 5 5L20 6" />
    </svg>
  );
}

// Service icons keyed by index (01–06), matching the original order.
export function ServiceIcon({ index }) {
  switch (index) {
    case 0:
      return (
        <svg viewBox="0 0 24 24">
          <circle cx="11" cy="11" r="7" />
          <path d="m21 21-4.3-4.3" />
        </svg>
      );
    case 1:
      return (
        <svg viewBox="0 0 24 24">
          <path d="M12 21s-7-5-7-11a7 7 0 0 1 14 0c0 6-7 11-7 11z" />
          <circle cx="12" cy="10" r="2.5" />
        </svg>
      );
    case 2:
      return (
        <svg viewBox="0 0 24 24">
          <path d="M3 3v18h18" />
          <path d="m7 14 4-4 3 3 5-6" />
        </svg>
      );
    case 3:
      return (
        <svg viewBox="0 0 24 24">
          <path d="M7 8h10M7 12h6" />
          <path d="M21 12a9 9 0 0 1-9 9 9 9 0 0 1-4-1l-5 1 1-4a9 9 0 1 1 17-5z" />
        </svg>
      );
    case 4:
      return (
        <svg viewBox="0 0 24 24">
          <rect x="3" y="4" width="18" height="14" rx="2" />
          <path d="M3 9h18M8 21h8" />
        </svg>
      );
    case 5:
      return (
        <svg viewBox="0 0 24 24">
          <path d="M4 19.5V6a2 2 0 0 1 2-2h12v16H6a2 2 0 0 1-2-2z" />
          <path d="M8 8h8M8 12h6" />
        </svg>
      );
    default:
      return null;
  }
}
