import { useEffect, useState } from "react";
import { PortfolioApi } from "../services/api";
import type { PortfolioSummary } from "../types";

export default function usePortfolio() {
  const [data, setData] = useState<PortfolioSummary | null>(null);
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(true);
  const fetchData = async () => {
    try {
      setLoading(true);
      // Direct await: This is the 'Senior' way to handle types
      const result = await PortfolioApi.getSummary();
      setData(result);
      setError("");
    } catch (err) {
      console.error("Fetch error:", err);
      setError("Error fetching data");
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchData();
  }, []);
  return { data, error, loading };
}
