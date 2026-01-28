const API_URL = "http://localhost/transaction-dashboard/public/api.php";
import { type PortfolioSummary, type Transaction } from "../types";
export const PortfolioApi = {
  async getSummary(): Promise<PortfolioSummary> {
    const response = await fetch(API_URL);
    return response.json();
  },

  async addTransaction(data: Transaction): Promise<{ status: string }> {
    const response = await fetch(API_URL, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data),
    });
    return response.json();
  },
};
