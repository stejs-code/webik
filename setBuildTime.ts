declare const Bun: any;

const appYamlPath = "./app.yaml";
const appYamlContent = await Bun.file(appYamlPath).text();

const currentTimestamp = Math.floor(Date.now() / 1000);

const updatedContent = appYamlContent.replace(
  /buildTime: \d+/,
  `buildTime: ${currentTimestamp}`
);

Bun.write(appYamlPath, updatedContent);

console.log(`Updated buildTime to ${currentTimestamp} in app.yaml`);
export {};
