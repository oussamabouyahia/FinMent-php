import { useEffect, useState } from "react";
import { PortfolioApi } from "../services/api";
import type { PortfolioSummary } from "../types";

export default function usePortfolio() {
  const [data, setData] = useState<PortfolioSummary | null>(null);
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(true);
  const fetchData = async () => {
    try {
      const response = await PortfolioApi.getSummary();
      setData(response);
      setLoading(false);
    } catch (error) {
      setError("Error fetching data");
      setLoading(false);
    }
  };
  useEffect(() => {
    fetchData();
  }, []);
  return { data, error, loading };
}
