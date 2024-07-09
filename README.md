# Trip Planner for Jordan

Trip Planner for Jordan is a specialized website designed to assist tourists in planning their trips to Jordan seamlessly. Our platform provides accurate and dependable guidance by leveraging practical experiences, ensuring users receive trustworthy information throughout their journey.

## Configuration

### MongoDB Configuration
Refer to `trip-planner/configuration/config.example.ini` to set up your MongoDB connection string.

### OpenAI Configuration
Provide your OpenAI secret key in the same configuration file.

## Modules

### Database Module
- **File**: `trip-planner/database/mongodb.py`
- **Description**: Connects to MongoDB using the provided configuration and manages user data operations such as adding new users and retrieving user information.

### Endpoint Modules
- **generate_trip_plan.py**: Offers trip planning advice based on user preferences and available travel options.
- **generate_reviews.py**: Allows users to create and submit reviews for different travel destinations and services in Jordan.

### Schemas
- **File**: `trip-planner/schemas/fastapi_schemas.py`
- **Description**: Defines the data models for the application, including User, TripPlan, Review, and Destination.

### Dataset Generation
- **File**: `trip-planner/generate_dataset.py`
- **Description**: Utilizes OpenAI to fabricate travel-related content and tips based on user input and article content.

### Main Application
- **File**: `trip-planner/main.py`
- **Description**: The core FastAPI application that houses the API endpoints for the project.

## .gitignore

The `.gitignore` file of the project ensures that sensitive and unnecessary files are not tracked by Git. It encompasses patterns for Python byte-compiled files, distribution files, logs, environment files, etc.

## CSS

Trip Planner for Jordan incorporates Font Awesome Free 6.1.1 for icons and stylings.

## Getting Started

### Clone the Repository

```bash
git clone <repository-url>
