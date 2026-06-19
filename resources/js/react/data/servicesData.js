// Content for the Services page. Each section keeps the exact copy from the
// original standalone page. `collapsedRows` (5) matches the original collapse.

export const serviceSections = [
  {
    id: "seo",
    alt: false,
    imageRight: true, // table left, image right
    eyebrowClass: "ey1",
    thClass: "th1",
    tagClass: "tag1",
    number: "01 — SEO Support",
    title: "Search Engine Optimisation",
    intro:
      "Every service needed to make your website rank higher, attract more organic visitors and outperform competitors in search results.",
    image:
      "https://images.unsplash.com/photo-1562577309-4932fdd64cd1?w=640&q=80",
    imageAlt: "SEO analytics",
    cardTitle: "Rank higher, grow faster",
    cardText:
      "Our SEO specialists combine technical precision with content strategy to steadily improve your organic visibility month after month.",
    rows: [
      ["SEO Audit & Strategy", null, "Full audit, keyword research, competitor analysis and prioritised growth roadmap."],
      ["Technical SEO Fixes", null, "Crawl errors, indexing issues, redirect chains, broken links and site architecture improvements."],
      ["Google Penalty Recovery", null, "Recovery from manual actions, algorithm drops and toxic backlink disavow."],
      ["On-Page Optimisation", null, "Title tags, meta descriptions, headings, URLs, image alt text and internal linking."],
      ["Content SEO Optimisation", null, "Improving existing content for search intent, topical authority and E-E-A-T signals."],
      ["SEO Content Writing", "core", "SEO-driven blogs, long-form articles and conversion-focused landing page copy."],
      ["Off-Page & Link Building", null, "High-authority backlinks, guest posting campaigns and digital PR outreach."],
      ["Local SEO", "core", "Google Business Profile, citation building, map pack rankings and local search growth."],
      ["E-commerce SEO", null, "Product pages, category architecture, faceted navigation and structured data."],
      ["Schema & Structured Data", null, "FAQ, product, article and breadcrumb schema for rich results in Google."],
      ["Speed & Performance SEO", "adv", "Core Web Vitals, server response time, image compression and render-blocking fixes."],
      ["Competitor Analysis", null, "Keyword gap analysis, backlink comparison and SERP feature opportunities."],
      ["Monthly SEO Management", "core", "Continuous optimisation, algorithm monitoring and monthly performance reporting."],
      ["AI & Modern SEO", "new", "Semantic SEO, entity optimisation and visibility in AI-powered search experiences."],
    ],
  },
  {
    id: "marketing",
    alt: true,
    imageRight: false, // image left, table right
    eyebrowClass: "ey2",
    thClass: "th2",
    tagClass: "tag2",
    number: "02 — Digital Marketing",
    title: "Paid, Social & Brand Growth",
    intro:
      "Campaigns and strategies that put your business in front of the right audience — whether they're searching, scrolling or reading their inbox.",
    image:
      "https://images.unsplash.com/photo-1611162617474-5b21e879e113?w=640&q=80",
    imageAlt: "Social media marketing",
    cardTitle: "Reach, engage & convert",
    cardText:
      "From Google Ads to Instagram growth — we build campaigns that attract the right people and turn clicks into customers.",
    rows: [
      ["Google Ads (PPC)", "core", "Search, Display and Shopping campaign setup, bid strategy optimisation and weekly review."],
      ["Meta Ads", "core", "Campaign creation, creative testing, retargeting, pixel setup and ROAS-focused management."],
      ["Social Media Management", null, "Content planning, graphic design, scheduling and publishing across all major platforms."],
      ["Social Media Strategy", null, "Platform audit, audience personas, content pillars and competitor benchmarking."],
      ["Email Marketing", null, "Campaign design, copywriting, list segmentation, A/B testing and performance reporting."],
      ["Email Automation & Flows", null, "Welcome sequences, abandoned cart flows and post-purchase nurture series."],
      ["Influencer Outreach", null, "Niche influencer identification, brief creation, campaign management and ROI tracking."],
      ["Brand Identity & Design", "core", "Logo, brand guidelines, colour palette, typography and all brand collateral."],
      ["Landing Page & CRO", null, "Conversion-optimised pages, A/B testing, heatmap analysis and journey improvements."],
      ["YouTube & Video Marketing", null, "Video ad scripting, production brief, campaign setup and performance optimisation."],
      ["Reputation Management", null, "Review monitoring, response management and proactive review generation strategies."],
      ["Marketing Analytics", "adv", "GA4 setup, custom dashboards, attribution modelling and monthly insight reports."],
      ["Startup Launch Pack", "new", "Brand + website + GBP + social profiles + first-customer campaign as one package."],
    ],
  },
  {
    id: "technical",
    alt: false,
    imageRight: true, // table left, image right
    eyebrowClass: "ey3",
    thClass: "th3",
    tagClass: "tag3",
    number: "03 — Technical Support",
    title: "Web Development & Infrastructure",
    intro:
      "The technical foundation your business needs — fast, secure, reliable websites and systems built and maintained by our in-house team.",
    image:
      "https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=640&q=80",
    imageAlt: "Web development",
    cardTitle: "Built to perform & built to last",
    cardText:
      "Clean code, rigorous testing and an obsession with speed — every website we build is engineered to rank, convert and grow with your business.",
    rows: [
      ["Website Design & Build", "core", "Bespoke design on WordPress or Webflow — fully mobile-responsive, SEO-ready and fast."],
      ["Speed Optimisation", null, "Image compression, caching, CDN setup, code minification and server-level tuning."],
      ["Security & Maintenance", null, "SSL management, firewall setup, malware scanning and regular uptime monitoring."],
      ["Website Migration", null, "Safe platform migrations, domain transfers and 301 redirect preservation."],
      ["E-commerce Development", null, "WooCommerce and Shopify builds, product import and payment gateway integration."],
      ["API Integration", null, "Connecting CRMs, payment processors and booking systems to your website via APIs."],
      ["Hosting & Domain Management", null, "Managed hosting setup, domain registration, DNS configuration and server management."],
      ["Database Design", "advanced", "Relational and NoSQL architecture, query optimisation and secure data storage."],
      ["Progressive Web App", "new", "Offline-capable, app-like mobile experiences without an app store submission."],
      ["GDPR & Compliance", null, "Cookie consent, privacy policy generation and GDPR-compliant forms and tracking."],
      ["Technical Troubleshooting", null, "Diagnosing and fixing bugs, display issues and server errors across any platform."],
      ["Analytics & Tracking", null, "GA4, Google Tag Manager, Meta Pixel and custom event setup for full measurement."],
    ],
  },
  {
    id: "automation",
    alt: true,
    imageRight: false, // image left, table right
    eyebrowClass: "ey4",
    thClass: "th4",
    tagClass: "tag4",
    number: "04 — Application & Automation",
    title: "Apps, AI & Smart Automation",
    intro:
      "Custom-built applications and intelligent automation systems that save time, reduce manual work and help your business run at full speed.",
    image:
      "https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=640&q=80",
    imageAlt: "App automation AI",
    cardTitle: "Automate the routine, focus on growth",
    cardText:
      "From AI chatbots to CRM pipelines — we build smart systems that capture leads, follow up automatically and keep your team focused on what matters.",
    rows: [
      ["Mobile App Development", "core", "iOS and Android app design and build, App Store submission and post-launch support."],
      ["Web Application Development", null, "Custom dashboards, portals and SaaS platforms built to your exact specification."],
      ["AI Chatbot & Assistant", "new", "Intelligent chatbots for websites and WhatsApp — trained on your business for 24/7 lead capture."],
      ["Lead Follow-Up Automation", "core", "Automated SMS/email sequences triggered within 60 seconds of a new enquiry."],
      ["Booking Automation", null, "Automated booking confirmations, reminders and rescheduling flows."],
      ["Review Request Automation", null, "Post-job review request sequences that generate consistent Google and Trustpilot reviews."],
      ["CRM Setup & Integration", null, "HubSpot, Zoho or custom CRM — pipeline config, deal stages and team onboarding."],
      ["Workflow Automation", null, "Cross-platform workflows connecting forms, CRMs, email, Slack and spreadsheets."],
      ["E-commerce Automation", null, "Abandoned cart sequences, post-purchase flows and inventory alert automations."],
      ["AI Content Pipelines", "new", "Automated workflows that research, draft and schedule SEO articles at scale using AI."],
      ["Reporting Automation", null, "Automated weekly reports pulling data from ads, analytics and CRM to your inbox."],
    ],
  },
];

// Maps the short badge keys above to label + class used in the original.
export const badgeMeta = {
  core: { label: "Core", cls: "b-core" },
  adv: { label: "Technical", cls: "b-adv" },
  advanced: { label: "Advanced", cls: "b-adv" },
  new: { label: "New", cls: "b-new" },
};
