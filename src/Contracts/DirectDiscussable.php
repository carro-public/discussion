<?php

namespace CarroPublic\Discussion\Contracts;

interfact DirectDiscussable
{
	/**
	 * Check discussion need approval or not
	 * 
	 * @param   mixed  $model Discussion's Model
	 * @return  bool          Describe approval or not
	 */
	public function discussionNeedApproval($model): bool;
}