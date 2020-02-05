    <!-- betterembed element -->
    <article class="betterembed js-betterembed">
      <button type="button" class="betterembed__show-original-element js-betterembed-show-message"></button>
      <div class="betterembed__item betterembed__type-{$itemType.LowerCase}">
        <header>
          <h3 class="betterembed__network">$itemType</h3>
        </header>
        <div class="betterembed__body">
          <div class="betterembed__msg">
            <p>
              With a click on the link below, the original content will be loaded. This can include remote content and you can possibly be tracked from the original provider.</p>
            <a href="#" class="betterembed__msg-button-primary js-betterembed-load-remote" data-beitemlink="/betterembed/{$ID}">show original content</a>
            <a href="#" class="betterembed__msg-button-secondary js-betterembed-close">close</a>
          </div>

          <% if thumbnailUrl %>
          <div class="betterembed__media">
            <img src="$thumbnailUrl" alt="embed image">
          </div>
          <% end_if %>

          <% if myTitle %>
          <h3 class="betterembed__title">$myTitle</h3>
          <% end_if %>

          <% if body %>
          <div class="betterembed__text">
            $body
          </div>
          <% end_if %>

          <% if authorName || publishedAt %>
          <footer class="betterembed__footer">
            <% if authorName %>
            <span class="betterembed__author">
            <% if authorUrl %>
            <a href="$authorUrl" target="_blank" rel="nofollow noopener">
            <% end_if %>
            $authorName
            <% if authorUrl %>
            </a>
            <% end_if %>
            </span>
            <% end_if %>
            <% if publishedAt %>
            <span>on $publishedAt.Format(d.m.Y)</span>
            <% end_if %>
          </footer>
          <% end_if %>

        </div>
      </div>
      <div class="betterembed__embed"></div>
    </article>
