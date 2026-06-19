import { BookingProvider } from "./context/BookingContext.jsx";
import { useHashRoute } from "./hooks/useHashRoute.js";
import HomePage from "./components/HomePage.jsx";
import ServicesPage from "./components/ServicesPage.jsx";
import PricingPage from "./components/PricingPage.jsx";
import LegalPage from "./components/LegalPage.jsx";
import BookingModal from "./components/BookingModal.jsx";
import { legalPages } from "./data/legalContent.js";

export default function App() {
  const route = useHashRoute();

  function renderPage() {
    if (route.startsWith("/services")) return <ServicesPage />;
    if (route.startsWith("/pricing")) return <PricingPage />;
    if (route.startsWith("/privacy-policy"))
      return <LegalPage page={legalPages.privacy} />;
    if (route.startsWith("/terms-of-service"))
      return <LegalPage page={legalPages.terms} />;
    if (route.startsWith("/cookie-policy"))
      return <LegalPage page={legalPages.cookies} />;
    return <HomePage />;
  }

  return (
    <BookingProvider>
      {renderPage()}
      <BookingModal />
    </BookingProvider>
  );
}
