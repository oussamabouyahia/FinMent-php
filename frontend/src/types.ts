export interface Transaction {
  amount: number; // amountInCents in PHP
  currency: string;
  description: string;
  formatted?: string; // Matches our jsonSerialize output
}

export interface PortfolioSummary {
  total: number;
  count: number;
}
