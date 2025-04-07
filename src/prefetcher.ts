type Loader = {
  url: string;
  fetchedAt: Date;
  promise: Promise<string>;
};

export const loaders = new Map<string, Loader>();

document.addEventListener("DOMContentLoaded", () => {
  mountPrefetcher();
});

window.addEventListener("popstate", async (event) => {
  if (event.state && event.state.url) {
    await navigate(event.state.url, false);
  }
});

window.history.replaceState(
  { url: window.location.href },
  "",
  window.location.href
);

export function mountPrefetcher() {
  const links = document.querySelectorAll("a[spa]");

  links.forEach((link) => {
    if (link.getAttribute("spa") === "prefetch") {
      link.addEventListener("mouseenter", (e) => {
        const href = link.getAttribute("href");
        if (!href) return;

        prefetch(href);
      });
    }

    link.addEventListener("click", (e) => {
      e.preventDefault();
      const href = link.getAttribute("href");
      if (!href) return;

      navigate(href);
    });
  });
}

export function freeCache() {
  loaders.forEach((loader) => {
    if (loader.fetchedAt < new Date(Date.now() - 1000 * 60 * 5)) {
      loaders.delete(loader.url);
    }
  });

  if (loaders.size > 30) {
    console.log("Cache is full, freeing some...");

    const loadersArray = Array.from(loaders.values());

    loadersArray.sort((a, b) => a.fetchedAt.getTime() - b.fetchedAt.getTime());

    loadersArray.slice(0, loadersArray.length - 10).forEach((loader) => {
      loaders.delete(loader.url);
    });
  }
}

export function prefetch(url: string) {
  if (loaders.has(url)) {
    const loader = loaders.get(url);

    if (loader!.fetchedAt > new Date(Date.now() - 1000 * 60 * 5)) {
      return loader;
    }
  }

  try {
    const loader: Loader = {
      url,
      fetchedAt: new Date(),
      promise: fetch(url).then((res) => res.text()),
    };

    loaders.set(url, loader);

    return loader;
  } catch (e) {
    console.error("Failed prefetching", url);
  }
}

export async function navigate(url: string, updateHistory = true) {
  const loader = await prefetch(url);

  if (!loader) {
    console.error("Failed to navigate", url);
    return;
  }

  const response = await loader.promise;

  if (!response) {
    console.error("Failed to navigate", url);
    return;
  }

  const parser = new DOMParser();
  const doc = parser.parseFromString(response, "text/html");

  const titleElement = doc.querySelector("title");
  if (titleElement) {
    document.title = titleElement.textContent || "";
  }

  document.body.innerHTML = doc.body.innerHTML;

  if (updateHistory) {
    window.history.pushState({ url }, "", url);
  }

  mountPrefetcher();
}
