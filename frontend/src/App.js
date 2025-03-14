import React, { useState } from 'react';
import StockSelector from './components/StockSelector';
import StockChart from './components/StockChart';

const App = () => {
  const [selectedStock, setSelectedStock] = useState('');
  const [stockData, setStockData] = useState([]);

  const stocks = ['GARAN', 'AKBNK', 'ISCTR']; // Örnek hisse senetleri

  const handleSelect = (sembol) => {
    setSelectedStock(sembol);
    // Burada API çağrısı yaparak seçilen hisse senedinin tahmin verilerini alabilirsiniz
    setStockData([
      { tarih: '2025-03-15', deger: 12.34 },
      { tarih: '2025-03-16', deger: 12.50 },
    ]); // Dummy data
  };

  return (
    <div>
      <h1>Hisse Senedi Tahmin Platformu</h1>
      <StockSelector stocks={stocks} onSelect={handleSelect} />
      {selectedStock && <StockChart data={stockData} />}
    </div>
  );
};

export default App; 