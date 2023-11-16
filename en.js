console.log("hElo");
import { OpenAI } from "./langchain/ll+ms/openai";
if (OpenAI) {
  console.log("helo");
} else {
  console.log("helooo");
}
// const llm = new OpenAI({
//   openAIApiKey: "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",
// });

// const res = await llm.predict("hello");
// console.log(res);
