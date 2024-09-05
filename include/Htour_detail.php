
<style>
    /* Container and Card Styles */
/* Container and Card Styles */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.card {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-bottom: 20px;
    position: relative;
}

.card-body {
    padding: 20px;
    background-color: #fff;
}

/* Section Header */
.card-title {
    font-size: 2rem;
    color: #333;
    margin-bottom: 20px;
}

/* Icon and Information Display */
.d-flex {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.d-flex > div {
    text-align: center;
    padding: 10px;
    flex: 1;
}

.d-flex > div i {
    font-size: 1.5rem;
    color: orange; /* Changed to orange */
    margin-bottom: 5px;
}

.d-flex > div p {
    margin: 0;
    font-size: 1rem;
    color: #555;
}

/* Description Styles */
h5 {
    font-size: 1.5rem;
    margin-top: 20px;
    color: #333;
}

p {
    font-size: 1rem;
    color: #555;
    line-height: 1.6;
}

/* Pricing Table Styles */
.pricing-table {
    width: 100%;
    margin: 20px 0;
    border-collapse: collapse;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.pricing-table th,
.pricing-table td {
    padding: 15px;
    border: 1px solid #ddd;
}

.pricing-table th {
    background-color: orange; /* Changed to orange */
    color: #fff;
    font-weight: bold;
}

.pricing-table td.price-value {
    color: #28a745;
    font-weight: bold;
}

.pricing-table .btn-book {
    text-align: center;
}

.tour-button {
    background-color: orange; /* Changed to orange */
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.tour-button:hover {
    background-color: yellow; /* Slightly darker orange for hover */
}

/* List Styles */
ul {
    list-style-type: disc;
    padding-left: 20px;
    color: #555;
    margin-top: 10px;
}

ul li {
    margin-bottom: 10px;
    font-size: 1rem;
    line-height: 1.6;
}

</style>