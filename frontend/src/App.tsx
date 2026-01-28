import "./App.css";

import usePortfolio from "./hooks/usePortfolio";

function App() {
  const { data, error, loading } = usePortfolio();
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
        <p>
          {data
            ? `Total Amount: ${data?.total} | Transaction Count: ${data?.count}`
            : "No data available"}
        </p>
      </div>
    </>
  );
}

export default App;
