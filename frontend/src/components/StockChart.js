import React from 'react';
import { Line } from 'react-chartjs-2';

const StockChart = ({ data }) => {
  const chartData = {
    labels: data.map(item => item.tarih),
    datasets: [
      {
        label: 'Tahmin Değeri',
        data: data.map(item => item.deger),
        fill: false,
        backgroundColor: 'rgba(75,192,192,0.2)',
        borderColor: 'rgba(75,192,192,1)',
      },
    ],
  };

  return <Line data={chartData} />;
};

export default StockChart; 