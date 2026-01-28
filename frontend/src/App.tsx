import { useEffect, useState } from "react";

import "./App.css";
import { PortfolioApi } from "./services/api";
import type { PortfolioSummary } from "./types";

function App() {
  const [data, setData] = useState<PortfolioSummary | null>(null);
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(true);
  const fetchData = async () => {
    try {
      PortfolioApi.getSummary().then((data) => {
        setLoading(false);
        return data;
      });
    } catch (error) {
      setError("Error fetching data");
    }
  };
  useEffect(() => {
    fetchData().then((data) => {
      setData(data);
    });
  }, []);
  if (loading) {
    return <p>Loading... </p>;
  }
  if (error) {
    return <p>{error} </p>;
  }
  return (
    <>
      <div className="App">
        <h1>Transaction Dashboard</h1>
        <ul>
          {data.map((item: any, index: number) => (
            <li key={index}>{JSON.stringify(item)}</li>
          ))}
        </ul>
      </div>
    </>
  );
}

export default App;
