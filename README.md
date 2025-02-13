# PHP Developer Quiz

## Question 1

### Modifications and Reasons:

1. Authentication Method: The original code used Basic Authentication, which is not recommended for security reasons. I have updated the code to use HMAC-SHA256 for request signing, as per Telesign's best practices.

2. HTTP Method: Changed the HTTP method from POST to GET, as the Phone ID API can be accessed via a GET request when the phone number is included in the URL path.

3. Endpoint URL: Updated the API endpoint URL to include the phone number directly in the path, which aligns with Telesign's API structure.

4. Date Header: Added the 'Date' header to the request, which is required for HMAC authentication.

5. Signature Generation: Implemented the correct process for generating the HMAC-SHA256 signature using the API key.

6. Authorization Header: Constructed the 'Authorization' header using the customer ID and the generated signature.

7. cURL Options: Set the appropriate cURL options to include the necessary headers and handle the response correctly.

8. Error Handling: Added error handling for cURL execution and response validation to ensure robustness.

9. Phone Type Validation: Simplified the validation logic by directly checking if the 'phone_type' description is in the list of valid types ('Fixed Line' or 'Mobile').

## Question 2

### Conclusions from the Data
#### Once the scatter plot is generated, I would analyze it for trends, clusters, or correlations. Here are a few possible observations that could be made:

1. Correlation:

- If the points follow an upward trend, it suggests a positive correlation between the X and Y values (i.e., as X increases, Y also increases).
- If the points follow a downward trend, there’s a negative correlation (as X increases, Y decreases).
If the points are randomly scattered without a clear trend, it suggests no strong correlation.

2. Clusters and Outliers:

- If the points form distinct groups, this might indicate clusters of similar data points.
- Any points that are far from the main cluster could be outliers, which might indicate anomalies in the dataset.

3. Data Distribution:

- If the points are evenly spread out, the dataset might be well-distributed.
- If most points are concentrated in a specific range, it might indicate a bias in the data.