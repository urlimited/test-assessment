# Test assessment
## Assumptions
1. The project uses Laravel's recommended best practices, especially when it comes to using Actions. An Action in Laravel is like a small tool designed to do one specific job. We had to decide between using Services or Actions. After looking at both, we chose Actions. One big reason is that they're easier to test and reuse. Each Action has a single method called handle, which takes a special kind of input called a DTO (Data Transfer Object). This is because requests can come in different shapes, and DTOs help standardize them, making it easier for our Actions to work with them.
2. For this test assessment, I decided not to implement Domain-Driven Design (DDD) or similar architectural concepts. I felt it would be overengineering for this specific task
3. Based on the assessment's requirements, it was obvious that the focus was on the backend part. That's why I didn't integrate SPA frameworks like React or Vue. But if needed, I can certainly provide such an implementation. For cleaner code after Ajax calls, I leveraged jQuery and the Observer pattern.

## How should you run the project:
Here are some essential commands tailored for this assessment:

1. `make` or `make init` - This is the primary setup command. It initiates the project deployment, spins up containers, segregates the scheduler into a distinct container, and executes migrations.

2. `make stop`: Use this to halt the containers.

3. `make start`: Resumes the operation of the halted containers.

4. `make test`: Initiates the tests. Please ensure the containers are running before executing this.

5. `make destroy`: This completely removes the containers.

6. `make log`: Handy for accessing the application container's log.


Please run the command `make` in the test assessment directory and open browser at `http://localhost/` url

Also, you can play around the config values in the file `configs/url_shortening` 
