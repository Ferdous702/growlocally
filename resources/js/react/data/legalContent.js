// Content for the legal pages. These are sensible, general-purpose templates
// for a UK digital marketing agency. Review with a solicitor before relying on
// them for compliance — they are a starting point, not legal advice.

const lastUpdated = "June 2026";

export const legalPages = {
  privacy: {
    slug: "privacy-policy",
    title: "Privacy Policy",
    updated: lastUpdated,
    intro:
      "This policy explains what personal information GrowLocally Ltd collects, why we collect it, and how we use and protect it. We are committed to handling your data lawfully, fairly and transparently in line with UK GDPR and the Data Protection Act 2018.",
    sections: [
      {
        h: "Who we are",
        body: [
          "GrowLocally Ltd is a digital marketing agency registered in the United Kingdom. For the purposes of data protection law, we are the data controller for the personal information we collect about you.",
          "If you have any questions about this policy, you can contact us at hello@growlocally.co.uk.",
        ],
      },
      {
        h: "Information we collect",
        body: ["We may collect and process the following information:"],
        list: [
          "Contact details you provide — such as your name, email address, phone number and business name — when you book a call, request an audit or submit an enquiry form.",
          "Information about your business and goals that you share with us so we can provide our services.",
          "Technical data such as your IP address, browser type and pages visited, collected automatically through cookies and analytics.",
        ],
      },
      {
        h: "How we use your information",
        body: ["We use your personal information to:"],
        list: [
          "Respond to your enquiries and arrange strategy calls or audits.",
          "Provide, manage and improve the services you have requested.",
          "Send you relevant updates about our services, where you have agreed to receive them.",
          "Meet our legal and regulatory obligations.",
        ],
      },
      {
        h: "Legal basis for processing",
        body: [
          "We process your data on the basis of your consent, to take steps at your request before entering into a contract, to perform a contract with you, and for our legitimate interests in operating and promoting our business — balanced against your rights.",
        ],
      },
      {
        h: "Sharing your information",
        body: [
          "We do not sell your personal information. We may share it with trusted service providers who help us run our business (for example, email, CRM and analytics providers), all of whom are required to protect your data. We may also disclose information where required by law.",
        ],
      },
      {
        h: "How long we keep it",
        body: [
          "We keep your personal information only for as long as necessary to fulfil the purposes set out in this policy, or as required to meet legal, accounting or reporting obligations.",
        ],
      },
      {
        h: "Your rights",
        body: ["Under UK data protection law you have the right to:"],
        list: [
          "Access the personal data we hold about you.",
          "Ask us to correct inaccurate or incomplete data.",
          "Ask us to delete your data in certain circumstances.",
          "Object to or restrict how we process your data.",
          "Withdraw consent at any time where we rely on it.",
        ],
      },
      {
        h: "Contact us",
        body: [
          "To exercise any of your rights, or for any privacy questions, please get in touch:",
        ],
        contact: true,
      },
    ],
  },

  terms: {
    slug: "terms-of-service",
    title: "Terms of Service",
    updated: lastUpdated,
    intro:
      "These terms govern your use of the GrowLocally website and the services we provide. By using our website or engaging our services, you agree to these terms. Please read them carefully.",
    sections: [
      {
        h: "About these terms",
        body: [
          "These terms are between you and GrowLocally Ltd. They apply to your use of our website and form the basis of any agreement for services, alongside any specific proposal or statement of work we agree with you.",
        ],
      },
      {
        h: "Our services",
        body: [
          "We provide digital marketing and related services, which may include SEO, paid advertising, social media, web development, applications and automation. The specific scope, deliverables and fees for your engagement will be set out separately in a proposal or agreement.",
          "While we work hard to deliver results, the nature of search engines, advertising platforms and online markets means we cannot guarantee specific rankings, traffic or revenue outcomes.",
        ],
      },
      {
        h: "Your responsibilities",
        body: ["When working with us, you agree to:"],
        list: [
          "Provide accurate information and timely access to any accounts, assets or approvals we need.",
          "Ensure you own or have the rights to any materials you supply to us.",
          "Use our services and website lawfully and not for any fraudulent or harmful purpose.",
        ],
      },
      {
        h: "Fees and payment",
        body: [
          "Fees, billing cycles and payment terms are set out in your specific agreement. Our plans are rolling and monthly with no long-term lock-in unless otherwise agreed in writing. Late or non-payment may result in services being paused.",
        ],
      },
      {
        h: "Intellectual property",
        body: [
          "Unless agreed otherwise, you own the final deliverables we create for you once payment has been made in full. We retain ownership of our own underlying tools, methods and pre-existing materials. Content on this website remains the property of GrowLocally Ltd.",
        ],
      },
      {
        h: "Limitation of liability",
        body: [
          "To the fullest extent permitted by law, GrowLocally Ltd is not liable for indirect or consequential losses, or for loss of profits, revenue or data arising from your use of our website or services. Nothing in these terms excludes liability that cannot lawfully be excluded.",
        ],
      },
      {
        h: "Ending an engagement",
        body: [
          "Either party may end a rolling engagement with reasonable notice as set out in your agreement. On termination, any outstanding fees for work performed remain payable.",
        ],
      },
      {
        h: "Governing law",
        body: [
          "These terms are governed by the laws of England and Wales, and any disputes will be subject to the exclusive jurisdiction of the courts of England and Wales.",
        ],
      },
      {
        h: "Contact us",
        body: ["Questions about these terms? Get in touch:"],
        contact: true,
      },
    ],
  },

  cookies: {
    slug: "cookie-policy",
    title: "Cookie Policy",
    updated: lastUpdated,
    intro:
      "This policy explains how GrowLocally uses cookies and similar technologies on our website, what they do, and how you can manage your preferences.",
    sections: [
      {
        h: "What are cookies?",
        body: [
          "Cookies are small text files placed on your device when you visit a website. They help the site function, remember your preferences and understand how visitors use the site.",
        ],
      },
      {
        h: "Types of cookies we use",
        body: ["We use the following categories of cookies:"],
        list: [
          "Essential cookies — required for the website to function properly. These cannot be switched off.",
          "Analytics cookies — help us understand how visitors interact with our site so we can improve it (for example, Google Analytics).",
          "Marketing cookies — used to measure the effectiveness of our advertising and show relevant content (for example, Meta Pixel).",
        ],
      },
      {
        h: "Managing cookies",
        body: [
          "You can control and delete cookies through your browser settings. Most browsers let you refuse or remove cookies; however, disabling essential cookies may affect how the website works. You can also adjust your preferences using any cookie banner shown on our site.",
        ],
      },
      {
        h: "Third-party cookies",
        body: [
          "Some cookies are set by third-party services that appear on our pages, such as analytics and advertising providers. These providers have their own privacy and cookie policies, which we encourage you to review.",
        ],
      },
      {
        h: "Updates to this policy",
        body: [
          "We may update this cookie policy from time to time to reflect changes in technology or law. Any changes will be posted on this page with an updated date.",
        ],
      },
      {
        h: "Contact us",
        body: ["Questions about our use of cookies? Get in touch:"],
        contact: true,
      },
    ],
  },
};
