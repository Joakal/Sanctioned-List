Feature:
In order to prove that search works
We want to submit a search then get the result page

Scenario: Query Submission Test
Given I am on "search"
When I fill in "search" with "John"
When I press "Search"
Then I should see "Searched for John"
