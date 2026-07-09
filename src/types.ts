export interface FAQItem {
  id: number;
  question: string;
  answer: string;
}

export interface StepItem {
  number: string;
  emoji: string;
  title: string;
  description: string;
}

export interface FeatureItem {
  id: string;
  icon: string;
  title: string;
  description: string;
}

export interface SolutionItem {
  title: string;
  description: string;
  features: string[];
  buttonText: string;
  isPopular?: boolean;
}
