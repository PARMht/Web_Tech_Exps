import React, { useState, useEffect } from 'react';
import axios from 'axios';

function App() {
  const [data, setData] = useState([]);
  const [searchQuery, setSearchQuery] = useState('');
  const [filteredData, setFilteredData] = useState([]);

  // Fetching real-time data from a server [cite: 24]
  useEffect(() => {
    axios.get('https://pokeapi.co/api/v2/pokemon?limit=50')
      .then(response => {
        setData(response.data.results);
        setFilteredData(response.data.results);
      })
      .catch(error => console.error("Error fetching data:", error));
  }, []);

  // Search functionality to filter API results dynamically 
  const handleSearch = (e) => {
    const query = e.target.value.toLowerCase();
    setSearchQuery(query);
    const filtered = data.filter(item =>
      item.name.toLowerCase().includes(query)
    );
    setFilteredData(filtered);
  };

  return (
    <div style={{ padding: '20px', fontFamily: 'Arial' }}>
      <h2>Experiment 10: API Integration</h2>
      
      {/* Search box filters results in real-time  */}
      <input
        type="text"
        placeholder="Search..."
        value={searchQuery}
        onChange={handleSearch}
        style={{ padding: '10px', width: '100%', marginBottom: '20px' }}
      />
      
      {/* Data fetched from API is displayed on screen  */}
      <ul>
        {filteredData.map((item, index) => (
          <li key={index}>{item.name}</li>
        ))}
      </ul>
    </div>
  );
}

export default App;