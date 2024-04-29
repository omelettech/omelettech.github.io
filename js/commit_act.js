$(document).ready(function() {
    const repos = [
        { owner: 'omelettech', repo: 'refresh' }

        // Add more repositories as needed
    ];

    const chartsContainer = $('#chartsContainer');

    const apiKey = "YOUR_GITHUB_API_KEY";

    repos.forEach(repo => {
        const url = `https://api.github.com/repos/${repo.owner}/${repo.repo}/stats/commit_activity`;

        // Fetch commit activity data from GitHub API using AJAX
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', `Bearer ${apiKey}`);
            },
            success: function(data) {
                console.log(data)
                const chartData = processData(data);
                createChart(repo.repo, chartData);
            },
            error: function(xhr, status, error) {
                console.error(`Error fetching data for ${repo.repo}:`, error);
            }
        });
    });

    // Function to process commit activity data
    function processData(data) {
        const commitCounts = data.map(day => day.total);
        return commitCounts;
    }

    // Function to create chart
    function createChart(repoName, data) {
        const canvas = $('<canvas></canvas>');
        canvas.attr('width', 400); // Adjust canvas size as needed
        canvas.attr('height', 300); // Adjust canvas size as needed
        canvas.addClass(`${repoName}Chart`);
        chartsContainer.append(canvas);

        new Chart(canvas[0], {
            type: 'line',
            data: {
                labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                datasets: [{
                    label: 'Commits',
                    data: data,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});