import { useReveal } from "../hooks/useReveal.js";
import Header from "./Header.jsx";
import Hero from "./Hero.jsx";
import Significance from "./Significance.jsx";
import Services from "./Services.jsx";
import WhyUs from "./WhyUs.jsx";
import Process from "./Process.jsx";
import CaseStudy from "./CaseStudy.jsx";
import Industries from "./Industries.jsx";
import Testimonials from "./Testimonials.jsx";
import Pricing from "./Pricing.jsx";
import About from "./About.jsx";
import Faq from "./Faq.jsx";
import FinalCta from "./FinalCta.jsx";
import Footer from "./Footer.jsx";

export default function HomePage() {
  // Scroll-reveal animations, run once after mount.
  useReveal();

  return (
    <>
      <Header />
      <main id="main">
        <Hero />
        <Significance />
        <Services />
        <WhyUs />
        <Process />
        <CaseStudy />
        <Industries />
        <Testimonials />
        <Pricing />
        <About />
        <Faq />
        <FinalCta />
      </main>
      <Footer />
    </>
  );
}
