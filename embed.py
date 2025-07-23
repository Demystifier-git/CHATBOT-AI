from sentence_transformers import SentenceTransformer
model = SentenceTransformer('all-MiniLM-L6-v2')  # fast, free model

sentences = [
  "I love cats",
  "I like kittens",
  "The Earth orbits the sun"
]

embeddings = model.encode(sentences)
for sent, vec in zip(sentences, embeddings):
  print(sent, "→", vec[:5], "...")  # show only first 5 numbers

import numpy as np

def cos_sim(a,b): return np.dot(a,b)/(np.linalg.norm(a)*np.linalg.norm(b))

print("Similarity: cats ↔ kittens =", cos_sim(embeddings[0], embeddings[1]))
print("cats ↔ earth-sun =", cos_sim(embeddings[0], embeddings[2]))
