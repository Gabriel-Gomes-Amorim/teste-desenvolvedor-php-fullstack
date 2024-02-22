FROM node:18-alpine

WORKDIR /app

COPY package.json .

RUN npm install

COPY .env .

COPY . .

RUN npm run build

EXPOSE 3333

CMD ["npm", "run", "preview"]
