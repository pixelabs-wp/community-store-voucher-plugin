class ExportToCSV {
    constructor(data) {
        this.data = data;
    }

    processData() {
        // Convert data to CSV format
        const csv = this.convertToCSV(this.data);

        // Create a Blob object from the CSV data
        const blob = new Blob([csv], { type: 'text/csv' });

        // Create a temporary anchor element to trigger the download
        const link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = 'export.csv';
        link.style.display = 'none';

        // Append the anchor element to the document body and click it programmatically
        document.body.appendChild(link);
        link.click();

        // Clean up
        document.body.removeChild(link);
    }

    convertToCSV(data) {
        const csvRows = [];
        const headers = Object.keys(data[0]);

        // Add header row
        csvRows.push(headers.join(','));

        // Add data rows
        data.forEach(row => {
            const values = headers.map(header => {
                const escaped = ('' + row[header]).replace(/"/g, '\\"');
                return `"${escaped}"`;
            });
            csvRows.push(values.join(','));
        });

        // Combine rows into a single CSV string
        return csvRows.join('\n');
    }
}
