import React from 'react';

const StockSelector = ({ stocks, onSelect }) => {
  return (
    <select onChange={(e) => onSelect(e.target.value)}>
      <option value="">Hisse Seçin</option>
      {stocks.map((stock) => (
        <option key={stock} value={stock}>{stock}</option>
      ))}
    </select>
  );
};

export default StockSelector; 