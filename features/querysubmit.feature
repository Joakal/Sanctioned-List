Feature:
In order to prove that search works
We want to submit a search then get the result page

Scenario: Query Submission Test
I fill in "search" with "John"
When I press "submit"
Then I should see "Searched for John"
