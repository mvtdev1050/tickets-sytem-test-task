
# Use official Node.js image
FROM node:20

# Set the working directory
#WORKDIR /src

# Copy package.json and package-lock.json for dependencies installation
COPY package*.json ./

# Install dependencies
RUN npm install

RUN npm install vite --save-dev

# Copy all files into the container
COPY . .

# Expose the port that Vue.js will run on
EXPOSE 8080

# Run the Vue.js app in development mode
CMD ["npm", "run", "serve"]
